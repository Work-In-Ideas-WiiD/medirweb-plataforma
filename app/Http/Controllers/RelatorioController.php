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
    public function index()
    {
        //
    }

    public function relatorioConsumo()
    {
        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('relatorio.consumo', compact('imoveis'));
    }

    public function relatorioFatura()
    {
        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        return view('relatorio.fatura', compact('imoveis'));
    }

    public function getConsumoLista(Request $request)
    {

        // FORMULARIO IMOVEL (GET)
        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }
        // FIM - FORMULARIO IMOVEL (GET)

        // VALIDAÇÃO CAMPO IMOVEL
        if(empty($request->input('CONSUMO_IMOVEL'))){
            return redirect('/relatorio/consumo')->with('error', 'Por Favor Selecione o Imóvel.');
        }
        // FIM - VALIDAÇÃO CAMPO IMOVEL

        // SUBMIT "EXPORTAR EXCEL"
        if($request->export == "excel"){
            return Excel::download(new LeituraExport($request->input('CONSUMO_IMOVEL'), $request->input('CONSUMO_DATA_ANTERIOR'), $request->input('CONSUMO_DATA_ATUAL')), 'relatorio_consumo.xlsx');
        }

        // SUBMIT "FILTRAR"
        if($request->filtrar == "filtrar"){

            //Validação se esta vazio campo hidrometro
            if(empty($request->PRU_ID) || ($request->PRU_ID == "Selecione Hidrômetro")){

                // INICIALIZAÇÃO de arrays
                $apartamentoGrafico = array();
                $consumoGrafico = array();
                $consumos = array();
                $consumoAvancados = null;
                // FIM - INICIALIZAÇÃO de arrays

                // RESULTADO DA PESQUISA CONSUMO COMPLETO
                $unidades = Imovel::find($request->input('CONSUMO_IMOVEL'))->getUnidades;
                foreach ($unidades as $unid) {
                    $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
                    foreach ($prumadas as $prumada)
                    {
                        $leituraAnterior = $prumada->getLeituras() ->where('created_at', '>=', date($request->input('CONSUMO_DATA_ANTERIOR')).' 00:00:00')->orderBy('created_at', 'asc')->first();

                        $leituraAtual = $prumada->getLeituras() ->where('created_at', '<=', date($request->input('CONSUMO_DATA_ATUAL')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                        if(isset($leituraAnterior) && isset($leituraAtual))
                        {
                            $consumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

                            if($consumo > 10 && $consumo <= 15)
                            {
                                $valor = (($consumo - 10) * 11.37) + 59;
                            }
                            elseif ($consumo > 15)
                            {
                                $valor = (($consumo - 10) * 13.98) + 59;
                            }
                            else
                            {
                                $valor = 59;
                            }

                            $relatorio_consumos = array(
                                'Imovel' => $unid->imovel->IMO_NOME,
                                'IndiceGeral' => $prumada->PRU_ID,
                                'Nomes' => $unid->UNI_RESPONSAVEL,
                                'Apartamentos' => $unid->UNI_NOME,
                                'LeituraAnterior' => $leituraAnterior->LEI_METRO,
                                'LeituraAtual' => $leituraAtual->LEI_METRO,
                                'Consumo' => $consumo,
                                'Valor' => number_format($valor, 2, ',', '.'),
                                'DataLeituraAnterior' => date('d/m/Y - H:i', strtotime($leituraAnterior->created_at)),
                                'DataLeituraAtual' => date('d/m/Y - H:i', strtotime($leituraAtual->created_at)),
                            );

                            array_push($consumos, $relatorio_consumos);

                            //ARRAY GRAFICO
                            $arrayApartamentoGrafico = [$unid->UNI_NOME];
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
                $consumos = null;
                $chartConsumoPizza = null;

                $consumoAvancados = array();
                $consumoAnoAnterior = array();
                $consumoAnoAtual = array();
                // FIM - INICIALIZAÇÃO de arrays

                // RESULTADO DA PESQUISA CONSUMO AVANÇADO
                $hidromentros = Unidade::find($request->input('PRU_ID'))->getPrumadas;

                foreach ($hidromentros as $hidromentro)
                {
                    $leituraAnterior = $hidromentro->getLeituras() ->where('created_at', '>=', date($request->input('CONSUMO_DATA_ANTERIOR')).' 00:00:00')->orderBy('created_at', 'asc')->first();

                    $leituraAtual = $hidromentro->getLeituras() ->where('created_at', '<=', date($request->input('CONSUMO_DATA_ATUAL')).' 23:59:59')->orderBy('created_at', 'desc')->first();

                    if(isset($leituraAnterior) && isset($leituraAtual))
                    {
                        $consumo =  $leituraAtual->LEI_METRO - $leituraAnterior->LEI_METRO;

                        if($consumo > 10 && $consumo <= 15)
                        {
                            $valor = (($consumo - 10) * 11.37) + 59;
                        }
                        elseif ($consumo > 15)
                        {
                            $valor = (($consumo - 10) * 13.98) + 59;
                        }
                        else
                        {
                            $valor = 59;
                        }


                        $relatorio_consumoAvancados = array(
                            'IndiceGeral' => $hidromentro->PRU_ID,
                            'LeituraAnterior' => $leituraAnterior->LEI_METRO,
                            'LeituraAtual' => $leituraAtual->LEI_METRO,
                            'Consumo' => $consumo,
                            'Valor' => number_format($valor, 2, ',', '.'),
                            'DataLeituraAnterior' => date('d/m/Y - H:i', strtotime($leituraAnterior->created_at)),
                            'DataLeituraAtual' => date('d/m/Y - H:i', strtotime($leituraAtual->created_at)),
                        );

                        array_push($consumoAvancados, $relatorio_consumoAvancados);

                        // ARRAY GRAFICO CONSUMO MENSAL
                        $anoAnterior = date("Y", strtotime('-1 year'));
                        $anoAtual = date("Y");

                        for ($mes=1; $mes <= 12; $mes++) {
                            $leituraAnoAnterior = $hidromentro->getLeituras() ->where('created_at', '<=', date("Y-m-d", strtotime($anoAnterior."-".$mes."-31")).' 23:59:59')
                            ->orderBy('created_at', 'desc')->first();

                            $leituraAnoAtual = $hidromentro->getLeituras() ->where('created_at', '<=', date("Y-m-d", strtotime($anoAtual."-".$mes."-31")).' 23:59:59')
                            ->orderBy('created_at', 'desc')->first();

                            $arrayConsumoAnoAnterior = array($leituraAnoAnterior['LEI_METRO']);
                            $arrayConsumoAnoAtual = array($leituraAnoAtual['LEI_METRO']);

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

    public function showPrumada($id)
    {
        $retorno = array();

        $unidades = Imovel::find($id)->getUnidades;
        foreach ($unidades as $unid) {
            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
            foreach ($prumadas as $prumada)
            {
                $pru = ['PRU_ID' => $prumada->PRU_ID,
                'UNI_NOME' => $prumada->unidade->UNI_NOME];
                array_push($retorno, $pru);
            }

            if(is_null($pru)){
                return redirect( URL::previous() );
            }
        }

        return json_encode($retorno);
    }

}
