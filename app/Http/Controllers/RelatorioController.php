<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;
use App\Models\Unidade;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeituraExport;
use App\Charts\ConsumoCharts;

class RelatorioController extends Controller
{
    public function tarifa($consumo){

        if($consumo > 10 && $consumo <= 15) {
            $valor = (($consumo - 10) * 11.37) + 59;
        } elseif ($consumo > 15) {
            $valor = (($consumo - 10) * 13.98) + 59;
        } else {
            $valor = 59;
        }

        return $valor;
    }

    public function array_value_recursive($key, array $arr){
        $val = array();
        array_walk_recursive($arr, function($v, $k) use($key, &$val){
            if($k == $key) array_push($val, $v);
        });
        $valu = array_map(function($value){return (int)$value;},$val);
        return count($valu) > 1 ? $valu : array_pop($valu);
    }

    public function relatorioConsumo()
    {
        if(app('defender')->hasRoles('Administrador'))
            $imoveis = Imovel::pluck('nome', 'id');
        else if(app('defender')->hasRoles(['Sindico', 'Secretário']))
            $imoveis = auth()->user()->imovel()->pluck('nome', 'id');
        else
            return abort(403, 'Você não tem permissão');

        return view('relatorio.consumo', compact('imoveis'));
    }

    public function getConsumoLista(Request $request)
    {

        // FORMULARIO IMOVEL (GET)
        $user = auth()->user()->imovel_id;
        $imoveis = ['' => 'Selecionar Imovel'];

        if(app('defender')->hasRoles('Administrador')){
            $_imoveis = Imovel::get();
        }else if(app('defender')->hasRoles(['Sindico', 'Secretário'])){
            $_imoveis = Imovel::get()->where('id', $user);
        }else{
            return view('error403');
        }

        foreach($_imoveis as $imovel){
            $imoveis[$imovel->id] = $imovel->nome;
        }
        // FIM - FORMULARIO IMOVEL (GET)

        // VALIDAÇÃO CAMPO IMOVEL
        if(!$request->imovel_id){
            return back()->with('error', 'Por Favor Selecione o Imóvel.');
        }
        // FIM - VALIDAÇÃO CAMPO IMOVEL

        // SUBMIT "EXPORTAR EXCEL"
        if($request->export == "excel"){
            return Excel::download(new LeituraExport($request->imovel_id, $request->CONSUMO_DATA_ANTERIOR, $request->CONSUMO_DATA_ATUAL), 'relatorio_consumo.xlsx');
        }

        // SUBMIT "FILTRAR"
        if($request->filtrar == "filtrar"){

            //Validação se esta vazio campo hidrometro
            if(!$request->unidade_id){

                // INICIALIZAÇÃO de arrays
                $apartamentoGrafico = array();
                $consumoGrafico = array();
                $consumos = array();
                $consumoAvancados = null;
                // FIM - INICIALIZAÇÃO de arrays

                // RESULTADO DA PESQUISA CONSUMO COMPLETO
                $unidades = Imovel::find($request->input('imovel_id'))->unidade;
                foreach ($unidades as $unid) {
                    $prumadas = $unid->prumada;
                    foreach ($prumadas as $prumada)
                    {
                        $leituraAnterior = $prumada->leitura()->where('created_at', '>=', date($request->CONSUMO_DATA_ANTERIOR).' 00:00:00')->orderBy('created_at', 'asc')->first();

                        $leituraAtual = $prumada->leitura()->where('created_at', '<=', date($request->CONSUMO_DATA_ATUAL).' 23:59:59')->orderBy('created_at', 'desc')->first();

                        // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                        if(!(isset($leituraAnterior))){
                          $leituraAnterior = $leituraAtual;
                        }

                        if(isset($leituraAnterior) && isset($leituraAtual))
                        {
                            $consumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

                            $valor = RelatorioController::tarifa($consumo);

                            $relatorio_consumos = array(
                                'Imovel' => $unid->imovel->nome,
                                'PRU_ID' => $prumada->id,
                                'PRU_NOME' => $prumada->nome,
                                'Nomes' => $unid->nome_responsavel,
                                'Apartamentos' => $unid->nome,
                                'LeituraAnterior' => $leituraAnterior->metro,
                                'LeituraAtual' => $leituraAtual->metro,
                                'Consumo' => $consumo,
                                'Valor' => number_format($valor, 2, ',', '.'),
                                'DataLeituraAnterior' => date('d/m/Y - H:i', strtotime($leituraAnterior->created_at)),
                                'DataLeituraAtual' => date('d/m/Y - H:i', strtotime($leituraAtual->created_at)),
                            );

                            array_push($consumos, $relatorio_consumos);

                            //ARRAY GRAFICO
                            $arrayApartamentoGrafico = [$unid->nome];
                            array_push($apartamentoGrafico, $arrayApartamentoGrafico);
                            $arrayConsumoGrafico = [$consumo];
                            array_push($consumoGrafico, $arrayConsumoGrafico);
                            // FIM - ARRAY GRAFICO
                        }
                    }
                }

                // GRAFICO CONSUMO POR APARTAMENTO (TYPE: PIZZA)
                $chartConsumoPizza = new ConsumoCharts;
                $chartConsumoPizza->displayAxes(false)
                ->title("Consumo por Apartamentos")
                ->labels($apartamentoGrafico)
                ->displayLegend(false)
                ->dataset('Consumo', 'pie', $consumoGrafico)
                ->backgroundcolor(['#00ff00','#ff0000','#0000ff','#ffcc00','#330000','#336633','#336666','#336699','#3366CC','#3366FF','#00FFFF','#336600',
                '#CC6600','#CC6633','#CC6666','#CC6699','#CC66CC','#CC66FF','#CC9900','#CC9933','#CC9966','#CC9999','#CC99CC','#CC99FF','#333300','#333333',
                '#CCCC00','#CCCC33','#CCCC66','#CCCC99','#CCCCCC','#CCCCFF','#CCFF00','#CCFF33','#CCFF66','#CCFF99','#CCFFCC','#CCFFFF','#333366','#333399',
                '#FF0000','#FF0033','#FF0066','#FF0099','#FF00CC','#FF00FF','#FF3300','#FF3333','#FF3366','#FF3399','#FF33CC','#FF33FF','#3333CC','#3333FF',
                '#FF6600','#FF6633','#FF6666','#FF6699','#FF66CC','#FF66FF','#66FF00','#66FF33','#66FF66','#66FF99','#66FFCC','#66FFFF','#3366CC','#3366FF',
                '#FF9900','#FF9933','#FF9966','#FF9999','#FF99CC','#FF99FF','#66CC00','#66CC33','#66CC66','#66CC99','#66CCCC','#66CCFF','#336666','#336699',
                '#FFCC00','#FFCC33','#FFCC66','#FFCC99','#FFCCCC','#FFCCFF','#669900','#669933','#669966','#669999','#6699CC','#6699FF','#336600','#336633',
                '#FFFF00','#FFFF33','#FFFF66','#FFFF99','#FFFFCC','#FFFFFF','#666600','#666633','#666666','#666699','#6666CC','#6666FF','#3300CC','#3300FF',
                '#000000','#000033','#000066','#000099','#0000CC','#0000FF','#663300','#663333','#663366','#663399','#6633CC','#6633FF','#330066','#330099',
                '#003300','#003333','#003366','#003399','#0033CC','#0033FF','#660000','#660033','#660066','#660099','#6600CC','#6600FF','#330033','#330033',
                '#006600','#006633','#006666','#006699','#0066CC','#0066FF','#33FF00','#33FF33','#33FF66','#33FF99','#33FFCC','#33FFFF','#00FF99','#00FFCC',
                '#009900','#009933','#009966','#009999','#0099CC','#0099FF','#33CC00','#33CC33','#33CC66','#33CC99','#33CCCC','#33CCFF','#00FF00','#000000',
                '#00CC00','#00CC33','#00CC66','#00CC99','#00CCCC','#00CCFF','#339900','#339933','#339966','#339999','#3399CC','#3399FF','#00FF33','#00FF66']);
                // FIM - GRAFICO CONSUMO POR APARTAMENTO (TYPE: PIZZA)

                // GRAFICO CONSUMO POR APARTAMENTO (TYPE: LINE)
                $chartConsumoLine = new ConsumoCharts;
                $chartConsumoLine->title("Consumo por Apartamentos")
                ->labels($apartamentoGrafico)
                ->dataset('Consumo', 'line', $consumoGrafico)
                ->backgroundcolor('#3c8dbc');
                // FIM - GRAFICO CONSUMO POR APARTAMENTO (TYPE: LINE)

            }else{
                // INICIALIZAÇÃO de arrays
                $anoAnterior = date("Y", strtotime('-1 year'));
                $anoAtual = date("Y");
                $consumos = null;
                $chartConsumoPizza = null;

                $consumoAvancados = array();
                $consumoAnoAnterior = array();
                $consumoAnoAtual = array();
                // FIM - INICIALIZAÇÃO de arrays

                // RESULTADO DA PESQUISA CONSUMO AVANÇADO
                $hidromentros = Unidade::find($request->unidade_id)->prumada;

                foreach ($hidromentros as $hidromentro)
                {
                    $leituraAnterior = $hidromentro->leitura()->where('created_at', '>=', date($request->CONSUMO_DATA_ANTERIOR).' 00:00:00')->orderBy('created_at', 'asc')->first();

                    $leituraAtual = $hidromentro->leitura()->where('created_at', '<=', date($request->CONSUMO_DATA_ATUAL).' 23:59:59')->orderBy('created_at', 'desc')->first();

                    // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                    if(!(isset($leituraAnterior))){
                      $leituraAnterior = $leituraAtual;
                    }

                    if(isset($leituraAnterior) && isset($leituraAtual))
                    {
                        $consumo =  $leituraAtual->metro - $leituraAnterior->metro;

                        $valor = RelatorioController::tarifa($consumo);

                        $relatorio_consumoAvancados = array(
                            'PRU_ID' => $hidromentro->id,
                            'PRU_NOME' => $hidromentro->nome,
                            'LeituraAnterior' => $leituraAnterior->metro,
                            'LeituraAtual' => $leituraAtual->metro,
                            'Consumo' => $consumo,
                            'Valor' => number_format($valor, 2, ',', '.'),
                            'DataLeituraAnterior' => date('d/m/Y', strtotime($leituraAnterior->created_at)),
                            'DataLeituraAtual' => date('d/m/Y', strtotime($leituraAtual->created_at)),
                        );

                        array_push($consumoAvancados, $relatorio_consumoAvancados);

                        // ARRAY GRAFICO CONSUMO MENSAL
                        

                        for ($mes=1; $mes <= 12; $mes++) {
                            $leituraAnoAnterior = $hidromentro->leitura()->where('created_at', '<=', date("Y-m-d", strtotime($anoAnterior."-".$mes."-31")).' 23:59:59')
                            ->orderBy('created_at', 'desc')->first();

                            $leituraAnoAtual = $hidromentro->leitura()->where('created_at', '<=', date("Y-m-d", strtotime($anoAtual."-".$mes."-31")).' 23:59:59')
                            ->orderBy('created_at', 'desc')->first();

                            // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                            if(!(isset($leituraAnterior))){
                              $leituraAnterior = $leituraAtual;
                            }

                            $arrayConsumoAnoAnterior = array($leituraAnoAnterior['metro']);
                            $arrayConsumoAnoAtual = array($leituraAnoAtual['metro']);

                            array_push($consumoAnoAnterior, $arrayConsumoAnoAnterior);
                            array_push($consumoAnoAtual, $arrayConsumoAnoAtual);
                        }
                        // FIM - ARRAY GRAFICO CONSUMO MENSAL
                    }
                }

                // GRAFICO CONSUMO MENSAL (TYPE: LINE)
                $chartConsumoLine = new ConsumoCharts;
                $chartConsumoLine->title("Media Consumo Mensal");
                $chartConsumoLine->labels(['31/JAN', '31/FEV', '31/MAR', '31/ABR', '31/MAI', '31/JUN', '31/JUL', '31/AGO', '31/SET', '31/OUT', '31/NOV', '31/DEZ']);
                $chartConsumoLine->dataset($anoAnterior, 'line', $consumoAnoAnterior)->backgroundcolor('#3c8dbc');
                $chartConsumoLine->dataset($anoAtual, 'line', $consumoAnoAtual)->backgroundcolor('#ffcc00');
                // GRAFICO CONSUMO MENSA (TYPE: LINE)

            }
        }

        return view('relatorio.consumo', compact('imoveis', 'consumos', 'consumoAvancados', 'chartConsumoPizza', 'chartConsumoLine'));
    }

    public function relatorioFatura()
    {       
        if(app('defender')->hasRoles('Administrador'))
            $imoveis = Imovel::pluck('nome', 'id');
        else if(app('defender')->hasRoles(['Sindico', 'Secretário']))
            $imoveis = auth()->user()->imovel()->pluck('nome', 'id');
        else
            return abort(403, 'você não tem permissão');


        return view('relatorio.fatura', compact('imoveis'));
    }

    public function getFaturaLista(Request $request)
    {
        if(app('defender')->hasRoles('Administrador'))
            $imoveis = Imovel::pluck('nome', 'id');
        else if(app('defender')->hasRoles(['Sindico', 'Secretário']))
            $imoveis = auth()->user()->imovel()->pluck('nome', 'id');
        else
            return abort(403, 'você não tem permissão');


        // SUBMIT "EXPORTAR PDF por Apartamento (individual)"
        if(!empty($request->pdf)){

            $dadosFaturaIndividual = array();

            $equipamentos = Unidade::find($request->pdf)->prumada;
            foreach ($equipamentos as $equipamento)
            {
                $leituraAnterior = $equipamento->leitura() ->where('created_at', '>=', date($request->DataAnteriorForm).' 00:00:00')->orderBy('created_at', 'asc')->first();
                $leituraAtual = $equipamento->leitura() ->where('created_at', '<=', date($request->DataAtualForm).' 23:59:59')->orderBy('created_at', 'desc')->first();

                // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                if(!(isset($leituraAnterior))){
                  $leituraAnterior = $leituraAtual;
                }

                if(isset($leituraAnterior) && isset($leituraAtual))
                {
                    $consumo =  $leituraAtual->metro - $leituraAnterior->metro;
                    $valor = RelatorioController::tarifa($consumo);

                    $arrayDadosFaturaIndividual = array(
                        'UNI_ID' => $equipamento->unidade_id,

                        'Imovel' => $equipamento->unidade->imovel->nome,
                        'cnpjImovel' => $equipamento->unidade->imovel->cnpj,
                        'Endereco' => $equipamento->unidade->imovel->endereco->logradouro." ".$equipamento->unidade->imovel->endereco->complemento.", Nº".$equipamento->unidade->imovel->endereco->numero,
                        'Bairro' => $equipamento->unidade->imovel->endereco->bairro,
                        'CityUF' => $equipamento->unidade->imovel->endereco->cidade->nome." - ".$equipamento->unidade->imovel->endereco->cidade->estado->codigo,
                        'CEP' => $equipamento->unidade->imovel->endereco->cep,
                        'responsaveisImovel' => $equipamento->unidade->imovel->IMO_RESPONSAVEIS ?? '',
                        'responsaveisTelImovel' => $equipamento->unidade->imovel->telefone[0]->numero ?? '',

                        'nomeAp' => $equipamento->unidade->nome,
                        'responsavelAp' => $equipamento->unidade->nome_responsavel,
                        'responsavelCpfAp' => $equipamento->unidade->cpf_responsavel,
                        'responsavelTelAp' => $equipamento->unidade->telefone->numero,

                        'PRU_ID' => $equipamento->id,
                        'PRU_NOME' => $equipamento->nome,
                        'LeituraAnterior' => $leituraAnterior->metro,
                        'LeituraAtual' => $leituraAtual->metro,
                        'Consumo' => $consumo,
                        'Valor' => number_format($valor, 2, ',', '.'),
                        'ValorSemFormato' => $valor,
                        'DataLeituraAnterior' => date('d/m/Y', strtotime($leituraAnterior->created_at)),
                        'DataLeituraAtual' => date('d/m/Y', strtotime($leituraAtual->created_at)),
                    );

                    array_push($dadosFaturaIndividual, $arrayDadosFaturaIndividual);
                }
            }

            return \PDF::loadView('relatorio.pdf.fatura_individual', compact('dadosFaturaIndividual'))
            ->download('fatura_individual.pdf');
        }

        // VALIDAÇÃO DATAS NÃO PASSAR DE 31 DIAS
        $date1=date_create($request->FATURA_DATA_ANTERIOR);
        $date2=date_create($request->FATURA_DATA_ATUAL);
        $diff=date_diff($date1,$date2);
        $dias = $diff->format("%a");

        if($dias >= 32 ){
            return back()->withError('Não é permitido datas maiores que 31 dias!');
        }
        // FIM - VALIDAÇÃO DATAS NÃO PASSAR DE 31 DIAS

        // VALIDAÇÃO CAMPO IMOVEL
        if(!$request->imovel_id)
            return back()->withError('Por Favor Selecione o Imóvel.');

        // FIM - VALIDAÇÃO CAMPO IMOVEL

        // SUBMIT "FILTRAR"
        if($request->filtrar == "filtrar"){

            //Validação se esta vazio campo hidrometro
            if(!$request->unidade_id){

                // INICIALIZAÇÃO de arrays
                $faturas = array();
                $faturaAvancados = null;
                // FIM - INICIALIZAÇÃO de arrays

                // RESULTADO DA PESQUISA FATURA COMPLETO
                $unidades = Imovel::find($request->imovel_id)->unidade;
                foreach ($unidades as $unid) {
                    $prumadas = $unid->prumada;
                    foreach ($prumadas as $prumada)
                    {
                        $leituraAnterior = $prumada->leitura()->where('created_at', '>=', date($request->FATURA_DATA_ANTERIOR).' 00:00:00')->orderBy('created_at')->first();
                        $leituraAtual = $prumada->leitura()->where('created_at', '<=', date($request->FATURA_DATA_ATUAL).' 23:59:59')->orderBy('created_at', 'desc')->first();

                        // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                        if(!(isset($leituraAnterior))){
                          $leituraAnterior = $leituraAtual;
                        }

                        if(isset($leituraAnterior) && isset($leituraAtual))
                        {
                            $consumo =  $leituraAtual->metro - $leituraAnterior->metro;
                            $valor = RelatorioController::tarifa($consumo);

                            $relatorio_faturas = array(
                                'UNI_ID' => $unid->id,
                                'PRU_NOME' => $prumada->nome,
                                'nomeAp' => $unid->nome,
                                'responsavelAp' => $unid->nome_responsavel,
                                'LeituraAnterior' => $leituraAnterior->metro,
                                'LeituraAtual' => $leituraAtual->metro,
                                'Consumo' => $consumo,
                                'Valor' => number_format($valor, 2, ',', '.'),
                                'DataAnteriorForm' => $request->FATURA_DATA_ANTERIOR,
                                'DataAtualForm' => $request->FATURA_DATA_ATUAL,
                            );
                            array_push($faturas, $relatorio_faturas);
                        }
                    }
                }
            }else{
                // INICIALIZAÇÃO de arrays
                $faturas = null;
                $faturaAvancados = array();
                // FIM - INICIALIZAÇÃO de arrays

                // RESULTADO DA PESQUISA FATURA AVANÇADO
                $equipamentos = Unidade::find($request->unidade_id)->prumada;
                foreach ($equipamentos as $equipamento)
                {
                    $leituraAnterior = $equipamento->leitura()->where('created_at', '>=', date($request->FATURA_DATA_ANTERIOR).' 00:00:00')->orderBy('created_at', 'asc')->first();
                    $leituraAtual = $equipamento->leitura()->where('created_at', '<=', date($request->FATURA_DATA_ATUAL).' 23:59:59')->orderBy('created_at', 'desc')->first();

                    // VALIDAÇÃO SE NAO TIVER LEITURA ANTEIOR
                    if(!(isset($leituraAnterior))){
                      $leituraAnterior = $leituraAtual;
                    }

                    if(isset($leituraAnterior) && isset($leituraAtual))
                    {
                        $consumo =  $leituraAtual->metro - $leituraAnterior->metro;
                        $valor = RelatorioController::tarifa($consumo);

                        $relatorio_faturaAvancados = array(
                            'UNI_ID' => $equipamento->unidade_id,
                            'PRU_ID' => $equipamento->id,
                            'PRU_NOME' => $equipamento->nome,
                            'LeituraAnterior' => $leituraAnterior->metro,
                            'LeituraAtual' => $leituraAtual->metro,
                            'Consumo' => $consumo,
                            'Valor' => number_format($valor, 2, ',', '.'),
                            'DataLeituraAnterior' => date('d/m/Y', strtotime($leituraAnterior->created_at)),
                            'DataLeituraAtual' => date('d/m/Y', strtotime($leituraAtual->created_at)),
                            'DataAnteriorForm' => $request->FATURA_DATA_ANTERIOR,
                            'DataAtualForm' => $request->FATURA_DATA_ATUAL,
                        );
                        array_push($faturaAvancados, $relatorio_faturaAvancados);
                    }
                }
            }
        }
 
        return view('relatorio.fatura', compact('imoveis', 'faturas', 'faturaAvancados'));
    }

}
