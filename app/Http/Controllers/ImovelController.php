<?php

namespace App\Http\Controllers;

use App\Models\Agrupamento;
use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\Prumada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Imovel\ImovelSaveRequest;
use App\Http\Requests\Imovel\ImovelEditRequest;
use App\Http\Requests\Imovel\LancarConsumoRequest;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Leitura;
use App\Models\Fatura;
use App\Models\FaturaUnidade;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\File;
use App\Charts\ConsumoCharts;
use Session, DB, Curl, Str;


class ImovelController extends Controller
{

    public function array_value_recursive($key, array $arr){
        $val = array();
        array_walk_recursive($arr, function($v, $k) use($key, &$val){
            if($k == $key) array_push($val, $v);
        });
        $valu = array_map(function($value){return (int)$value;},$val);
        return count($valu) > 1 ? $valu : array_pop($valu);
    }

    public function index()
    {
        if(app('defender')->hasRoles('Administrador')) {
            $imoveis = Imovel::with('endereco.cidade.estado')->get();
        } else if(app('defender')->hasRoles(['Sindico', 'Secretário'])) {
            $imoveis = auth()->user()->imovel()->with('endereco.cidade.estado')->get();
        }else
            return abort(403, 'você não tem permissão para ver essa página');
        

        return view('imovel.index', compact('imoveis'));
    }

    public function buscar()
    {      
        $estados = Estado::pluck('nome', 'id');

        $cidades = Cidade::whereEstadoId(1)->pluck('nome', 'id');

        return view('imovel.buscar', compact( 'estados', 'cidades'));
    }

    public function create()
    {
        $clientes = Cliente::whereStatus(1)->pluck('nome_juridico', 'id');

        $estados = Estado::pluck('nome', 'id');

        $cidades = Cidade::whereEstadoId(1)->pluck('nome', 'id');

        return view('imovel.create', compact('clientes', 'estados', 'cidades'));
    }

    public function store(ImovelSaveRequest $data)
    {
        $endereco = Endereco::create(
            $data->only('logradouro', 'bairro', 'cidade_id', 'numero', 'cep', 'complemento')
        );

        $imovel = new Imovel;

        $imovel->fill(
            $data->only('cliente_id', 'cnpj', 'nome', 'status', 'fatura_ciclo', 'taxa_fixa', 'taxa_variavel', 'ip', 'porta')
        );

        $imovel->endereco_id = $endereco->id;

        if($data->foto){
            $imovel->foto = Str::random(32).'.'.$data->file('foto')->extension();
            $data->file('foto')->move('upload/fotos', $imovel->foto);
        }

        if($data->hasFile('capa')){
            $imovel->capa = Str::random(32).'.'.$request->file('capa')->extension();
            $data->file('capa')->move('upload/capas', $imovel->capa);
        }

        $imovel->save();

        return back()->withSuccess('Imóvel cadastrado com sucesso.');
    }

    public function show(Imovel $imovel)
    {   
        $imovel = Imovel::with('unidade.telefone')->find($imovel->id);
        $chartConsumoLine = $this->graficoConsumoGeral($imovel->id);

        return view('imovel.show', compact('imovel', 'chartConsumoLine'));
    }


    public function show_buscar(Imovel $imovel)
    {

        $imovel['IMO_IDCIDADE'] = $imovel->endereco->cidade->nome;
        $imovel['IMO_IDESTADO'] = $imovel->endereco->cidade->estado->codigo;

        $agrupamentos = $imovel->agrupamento;
        $unidades = $imovel->unidade;

        // Ajuste para a criação de abas na view de forma correta
        //$agrupamentos = $agrupamentos->reverse();

        $unid = array();

        foreach ($agrupamentos as $key => $agrup) {
            foreach($unidades as $uni) {
                if($uni->agrupamento_id == $agrup->id) {
                    array_push($unid, $uni);
                }
            }
            if(count($unid) > 0) {
                $agrup->UNIDADES = $unid;
                $unid = [];
            }
            else {
                $agrup->UNIDADES = null;
            }
        }

        $chartConsumoLine = ImovelController::graficoConsumoGeral($imovel->id);

        return view('imovel.buscar_visualizar', compact('imovel', 'agrupamentos', 'unidades', 'chartConsumoLine'));
    }

    public function edit(Imovel $imovel)
    {
        $imovel = Imovel::with('unidade.telefone')->find($imovel->id);

        $clientes = Cliente::whereStatus(1)->pluck('nome_juridico', 'id');

        $estados = Estado::pluck('nome', 'id');

        $cidades = Cidade::pluck('nome', 'id');

        return view('imovel.edit', compact('clientes', 'imovel', 'estados', 'cidades'));
    }


    public function update(ImovelEditRequest $data, Imovel $imovel)
    {
        // SOMENTE USUARIO "CONTATO WIID" PODE ALTERAR O FECHAMENTO DA FATURA
        if(auth()->id() != 7 and $data->fatura_ciclo)
            return back()->withError('Não é permitido burlar o sistema!');


        if($data->hasFile('foto')){
            $foto_path = public_path("upload/fotos/".$imovel->foto);

            if (File::exists($foto_path))
                File::delete($foto_path);

            $imovel->foto = Str::random(32).'.'.$request->file('foto')->extension();
            $data->file('foto')->move('upload/fotos', $imovel->foto);

        }

        if($data->hasFile('capa')){
            $capa_path = public_path("upload/capas/".$imovel->capa);

            if (File::exists($capa_path))
                File::delete($capa_path);

            $imovel->capa = Str::random(32).'.'.$request->file('capa')->extension();
            $data->file('capa')->move('upload/capas', $imovel->capa);

        }

        $imovel->endereco->update(
            $data->only('logradouro', 'bairro', 'cidade_id', 'numero', 'cep', 'complemento')
        );

        $imovel->fill(
            $data->only('cliente_id', 'cnpj', 'nome', 'status', 'fatura_ciclo', 'taxa_fixa', 'taxa_variavel', 'ip', 'porta')
        );

        $imovel->save();

        return back()->withSuccess('Imóvel atualizado com sucesso.');
    }

    public function destroy(Request $request, Imovel $imovel)
    {
        $imovel->delete();

        return redirect('imovel')->withSuccess('Imovel deletado com sucesso!');
    }


    public function getLancarConsumo(Imovel $imovel)
    {
        if(app('defender')->hasRoles('Sindico') && auth()->user()->imovel_id !== $imovel->id){
            return abort(403, 'Você não tem permissão');
        }

        $mesCiclo = array();
        for ($i = ($imovel->fatura_ciclo - 5); $i <= ($imovel->fatura_ciclo + 5); $i++){
            if($i <= date("d")){
                $mesCiclo += [ date('Y-m-d', strtotime(date("Y-m")."-".$i))  => $i ];
            }
        }


        $faturas = $imovel->fatura()->whereMonth('data_leitura_fornecedor', now())->get();

        $ciclo =  $imovel->fatura_ciclo - date("d");

        if($ciclo >= -5 &&  $ciclo <= 5){

            foreach ($faturas as $fatura) {
                $mesLeiFornecedor = date('Y-m', strtotime($fatura->data_leitura_fornecedor));

                if($mesLeiFornecedor == date("Y-m")){
                    return view('imovel.lancarConsumo', compact('faturas', 'imovel'));
                }
            }

            return view('imovel.lancarConsumo', compact('mesCiclo', 'imovel'));
        }else {
            return back()->withError("Imovel {$imovel->nome}, esta fora do ciclo para lançamento do Consumo Mensal!");
        }

        return back()->withError('error desconhecido!');
    }


    public function postLancarConsumo(LancarConsumoRequest $request)
    {
        if(app('defender')->hasRoles('Sindico') && auth()->user()->imovel_id !== $request->imovel_id){
            return abort(403, 'Você não tem permissão');
        }

        // validação se o usuario tentar burlar o sistema
        // (DATA DA LEITURA)
        if (!(date('Y-m', strtotime($request->data_leitura_fornecedor)) == date('Y-m'))) {
            return back()->withError('Não é permitido burlar o sistema!');
        }

        // FORA DO CICLO
        $ciclo = date('d', strtotime($request->data_leitura_fornecedor)) - date('d');
        if(!($ciclo >= -5 &&  $ciclo <= 5)){
            return back()->with('error', 'Não é permitido burlar o sistema!');
        }

        // ENVIAR INFORMAÇÕES MAIS DE UMA VEZ
        $faturasValidation = Fatura::where('imovel_id', $request->imovel_id)->whereMonth('data_leitura_fornecedor', date("m"))->get();
        foreach ($faturasValidation as $value) {
            $result = date('Y-m', strtotime($value->data_leitura_fornecedor));
            if($result  == date("Y-m")){
                return back()->withError('ATENÇÃO! Este mês já foi coletado o consumo mensal do fornecedor! Não é permitido adicionar novamente!');
            }
        }
        // FIM VALIDAÇÃO

        $dataForm = $request->all();

        dd($dataForm);

        // Formatação ponto e virgula do valor que veio no formulario
        $formatarLeiMetroValorFor1 = str_replace(".", "", $dataForm['FAT_LEIMETRO_VALORFORNECEDOR']);
        $formatarLeiMetroValorFor = str_replace(",", ".", $formatarLeiMetroValorFor1);
        // fim - Formatação...


        // ##### *INICIO - PEGANDO TODAS LEITURAS DAS UNIDADES e SOMANDO E FAZENDO MEDIA DO MES ATUAL* #####
        $leituraAtual = array();
        $leituraAnterior = array();
        $leiMetroFornecedorAnterior = 0;
        $faturaUnidade = array();

        // BUSCAS
        $apartamentos = Imovel::findOrFail($dataForm['FAT_IMOID'])->getUnidades;
        if ($apartamentos->count() == 0) {
            return redirect('/imovel/ver/'.$dataForm['FAT_IMOID'])->with('error', 'Não tem unidades cadastrada neste Imovel');
        }

        foreach ($apartamentos as $unid) {

            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
            if ($prumadas->count() == 0) {
                return redirect('/imovel/ver/'.$dataForm['FAT_IMOID'])->with('error', 'Não tem equipamentos cadastrada neste Imovel');
            }

            foreach ($prumadas as $prumada){

                $fatCicloMenos1mes = date("Y-m-d", strtotime(date("Y-m")."-".$prumada->unidade->imovel->IMO_FATURACICLO.'-1 month'));

                //LEITURA DO MES ANTERIOR
                $getLeituraAnterior = $prumada->getLeituras()->where('created_at', '<=', $fatCicloMenos1mes.' 23:59:59')
                ->orderBy('created_at', 'desc')->first();
                array_push($leituraAnterior, $getLeituraAnterior['LEI_METRO']);
                // fim - LEITURA DO MES ANTERIOR

                // LEITURA DO MES ATUAL
                $getLeituraAtual = $prumada->getLeituras()->where('created_at', '<=', date("Y-m-d", strtotime($request->FAT_DTLEIFORNECEDOR)).' 23:59:59')
                ->orderBy('created_at', 'desc')->first();
                array_push($leituraAtual, $getLeituraAtual['LEI_METRO']);
                // fim - LEITURA DO MES ATUAL

                // VALIDAÇÃO LEITURA ANTERIOR = null
                if(!(isset($getLeituraAnterior))){
                  $getLeituraAnterior['LEI_METRO'] = 0;
                  $getLeituraAnterior['created_at'] = $fatCicloMenos1mes;
                }

                // CONSUMO POR PRUMADAS
                if( isset($getLeituraAtual)){
                    $consumo = $getLeituraAtual['LEI_METRO'] - $getLeituraAnterior['LEI_METRO'];

                    $relatorioConsumoUnidade = array(
                        'FATUNI_IDUNI' => $unid->UNI_ID,


                        'pru_id' => $prumada->PRU_ID,
                        'pru_nome' => $prumada->PRU_NOME,
                        'consumo' => $consumo,
                        'leiAnterior' => $getLeituraAnterior['LEI_METRO'],
                        'dtLeiAnterior' => date('Y-m-d', strtotime($getLeituraAnterior['created_at'])),
                        'leiAtual' => $getLeituraAtual['LEI_METRO'],
                        'dtLeiAtual' => date('Y-m-d', strtotime($getLeituraAtual['created_at'])),
                    );
                    array_push($faturaUnidade, $relatorioConsumoUnidade);
                }
                // fim

            }

        }// FIM - BUSCAS

        // mes anterior (SOMA)
        $leituraAnteriorInteger = array_map(function($value){return (int)$value;},$leituraAnterior);
        if(!is_array($leituraAnteriorInteger)){$leituraAnteriorInteger = array($leituraAnteriorInteger);}
        $somaLeituraAnterior = array_sum($leituraAnteriorInteger);
        //echo "SOMA LEITURA ANTERIOR: ".$somaLeituraAnterior."</br>";
        // fim - mes anterior

        // mes atual (SOMA)
        $leituraAtualInteger = array_map(function($value){return (int)$value;},$leituraAtual);
        if(!is_array($leituraAtualInteger)){$leituraAtualInteger = array($leituraAtualInteger);}
        $somaLeituraAtual = array_sum($leituraAtualInteger);
        //echo "SOMA LEITURA ATUAL: ".$somaLeituraAtual;
        // fim - mes atual

        // LEITURA DE TODAS AS UNIDADES DO MES ATUAL
        $dataForm['FAT_LEIMETRO_UNI'] = $somaLeituraAtual;

        // VERIFICANDO SE NO MES ANTERIOR FOI ADICIONADO O CONSUMO (SE MES ANTERIOR FOI ADIONADO ENTÃO VAI RECEBER O VALOR QUE ESTA NO BANCO)
        $faturas = Fatura::where('FAT_IMOID', $dataForm['FAT_IMOID'])->whereMonth('FAT_DTLEIFORNECEDOR', date("m", strtotime('-1 month')) )->get();
        foreach ($faturas as $fatura) {
            $mesLeiFornecedor = date('Y-m', strtotime($fatura->FAT_DTLEIFORNECEDOR));

            if($mesLeiFornecedor == date("Y-m", strtotime('-1 month'))){
                $somaLeituraAnterior = $fatura->FAT_LEIMETRO_UNI;
                $leiMetroFornecedorAnterior = $fatura->FAT_LEIMETRO_FORNECEDOR;
            }

            // Se o consumo do fornecedor for menor que mes anterior
            if($request->FAT_LEIMETRO_FORNECEDOR < $fatura->FAT_LEIMETRO_FORNECEDOR){
                return redirect('/imovel/'.$dataForm['FAT_IMOID'].'/consumo')->with('error', 'Leitura do Fornecedor esta menor que o mês anterior');
            }
        }
        // ##### *FIM - PEGANDO TODAS LEITURAS DAS UNIDADES e SOMANDO E FAZENDO MEDIA DO MES ATUAL* #####


        $consumoUnidades = $somaLeituraAtual - $somaLeituraAnterior;
        $ConsumoImovel = ($dataForm['FAT_LEIMETRO_FORNECEDOR'] - $leiMetroFornecedorAnterior ) - $consumoUnidades;
        $ConsumoFornecedor = $dataForm['FAT_LEIMETRO_FORNECEDOR'] - $leiMetroFornecedorAnterior;  // CONSUMO FORNECEDORES

        $dataForm['FAT_CONSUMO_UNI'] = $consumoUnidades; // CONSUMO DE TODAS UNIDADES DO MES ATUAL
        $dataForm['FAT_CONSUMO_IMOVEL'] = $ConsumoImovel; // CONSUMO AREA COMUM IMOVEL
        $dataForm['FAT_CONSUMO_FORNECEDOR'] = $ConsumoFornecedor; // CONSUMO DO FORNECEDOR

        // REGRA DE TRES (VALORES CONSUMO)
        $resultado = $dataForm['FAT_CONSUMO_UNI'] * $formatarLeiMetroValorFor;
        if($resultado == 0) {
            $valorConsumoUnidades = 0;
        }else if( $ConsumoFornecedor == 0){
            $valorConsumoUnidades = 0;
        }else{
            $valorConsumoUnidades = $resultado / $ConsumoFornecedor;
        }

        $valorConsumoImovel =  $formatarLeiMetroValorFor - $valorConsumoUnidades;
        // FIM

        $dataForm['FAT_CONSUMO_VALORUNI'] = number_format($valorConsumoUnidades, 2, ',', '.');
        $dataForm['FAT_CONSUMO_VALORIMOVEL'] = number_format($valorConsumoImovel, 2, ',', '.');

        // Se o consumo do fornecedor for menor que consumo das unidade
        if($dataForm['FAT_LEIMETRO_FORNECEDOR'] < $leiMetroFornecedorAnterior + $dataForm['FAT_CONSUMO_UNI']){
            return redirect('/imovel/'.$dataForm['FAT_IMOID'].'/consumo')->with('error', 'Leitura do Fornecedor esta menor que o Leitura total das unidades');
        }

        $faturaImovel = Fatura::create($dataForm);
        // FIM FATURA Imovel
        /*********/



        // Adicionando consumo das unidades
        foreach ($faturaUnidade as $key => $value) {

          setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.UTF-8', 'portuguese');
          date_default_timezone_set('America/Sao_Paulo');

          $value['FATUNI_DT'] = utf8_encode(ucwords(strftime('%B %Y', strtotime($faturaImovel->FAT_DTLEIFORNECEDOR))));
          $value['FATUNI_IDFATURA'] = $faturaImovel->FAT_ID;

          //CALCULO VALOR DE CADA PRUMADA
          $r1 = $value['consumo'] * $valorConsumoUnidades;
          if($r1 == 0){
              $valor = 0;
          }else{
              $valor = $r1 / $faturaImovel->FAT_CONSUMO_UNI;
          }
          $valorPrumada = number_format($valor, 2, ',', '.');
          // fim - calculo por prumada

          // ARRAY DE CADA PRUMADA
          $arrayPrumada = array(
              'PRU_ID' => $value['pru_id'],
              'PRU_NOME' => $value['pru_nome'],
              'PRU_CONSUMO' => $value['consumo'],
              'PRU_LEIANTERIOR' => $value['leiAnterior'],
              'PRU_DTLEIANTERIOR' => $value['dtLeiAnterior'],
              'PRU_LEIATUAL' => $value['leiAtual'],
              'PRU_DTLEIATUAL' => $value['dtLeiAtual'],
              'PRU_VALOR' => $valorPrumada,
          );

          $value['FATUNI_PRUMADAS'] = json_encode($arrayPrumada);

          $dadosFatUni = FaturaUnidade::where('FATUNI_IDFATURA', $value['FATUNI_IDFATURA'])->get();
          if ($dadosFatUni->count() == 0) {

              $value['FATUNI_VALORTOTAL'] = $valorPrumada;
              FaturaUnidade::create($value);
          } else {
              foreach ($dadosFatUni as $fatUni) {

                  $value['FATUNI_PRUMADAS'] = $fatUni->FATUNI_PRUMADAS.', '.$value['FATUNI_PRUMADAS'];

                  //  Valor Total da Unidade
                  $valorTotalDBSemPonto =  str_replace(".", "",$fatUni->FATUNI_VALORTOTAL);
                  $valorTotalDBVirculaparaPonto =  str_replace(",", ".",$valorTotalDBSemPonto);

                  $uniValor = array_sum(array($valorTotalDBVirculaparaPonto, $valor));
                  $value['FATUNI_VALORTOTAL'] = number_format($uniValor, 2, ',', '.');
                  // fim

                  $fatUni->update($value);
              }
          }

        }
        // FIM

        return redirect('imovel')->with('success', 'Adicionado o com sucesso as informações da fatura do fornecedor!');
    }


    public function graficoConsumoGeral($id)
    {
        // INICIALIZAÇÃO de variaveis
        $leiMensalAnoAnterior = array();
        $leiMensalAnoAtual = array();
        $somaConsumoAnoAnterior = array();
        $somaConsumoAnoAtual = array();
        $anoAnterior = date("Y", strtotime('-1 year'));
        $anoAtual = date("Y");
        // FIM - INICIALIZAÇÃO de variaveis

        // BUSCAS
        $apartamentos = Imovel::with('unidade.prumada', 'endereco')->find($id);

        foreach ($apartamentos->unidade as $unid) {
            $prumadas = $unid->prumada;
            foreach ($prumadas as $prumada){

                // TODAS AS LEITURAS DE TODOS OS EQUIPAMENTOS SEPARADOS MENSALMENTE
                for ($mes=1; $mes <= 12; $mes++) {

                    $leituraAnoAnterior = $prumada->leitura()
                        ->where('created_at', '<=', date("Y-m-d", strtotime($anoAnterior."-".$mes."-31")).' 23:59:59')
                        ->orderBy('created_at', 'desc')->first();

                    $leituraAnoAtual = $prumada->leitura()
                        ->where('created_at', '<=', date("Y-m-d", strtotime($anoAtual."-".$mes."-31")).' 23:59:59')
                        ->orderBy('created_at', 'desc')->first();

                    $arrayLeiMensalAnoAnterior = array('mes' => array('mes'.$mes => $leituraAnoAnterior['LEI_METRO'] ?? 0));
                    $arrayLeiMensalAnoAtual = array('mes' => array('mes'.$mes => $leituraAnoAtual['LEI_METRO'] ?? 0));

                    array_push($leiMensalAnoAnterior, $arrayLeiMensalAnoAnterior);
                    array_push($leiMensalAnoAtual, $arrayLeiMensalAnoAtual);
                }// fim - TODAS AS LEITUAS ...
            }
        }// FIM - BUSCAS

        // FUNÇÃO PEGAR VALOR DA INDEX DA ARRAY E CONVERTER O VALOR PARA (INT)
        function array_value_recursive($key, array $arr){
            $val = array();
            array_walk_recursive($arr, function($v, $k) use($key, &$val){
                if($k == $key) array_push($val, $v);
            });
            $valu = array_map(function($value){return (int)$value;},$val);
            return count($valu) > 1 ? $valu : array_pop($valu);
        }// fim - função...

        // CALCULOS - SOMA LEITURAS MENSAL TOTAL e DEPOIS FAZ A MEDIA MENSAL (consumo)
        for ($mes=1; $mes <= 12; $mes++) {

            if(!empty($leiMensalAnoAnterior) || !empty($leiMensalAnoAtual)){

                // ano anterior (SOMA)
                $leiMensalAnoAnteriorNew = array_value_recursive('mes'.$mes, $leiMensalAnoAnterior);
                if($leiMensalAnoAnteriorNew == null){$leiMensalAnoAnteriorNew = array(0);}
                if(!is_array($leiMensalAnoAnteriorNew)){$leiMensalAnoAnteriorNew = array($leiMensalAnoAnteriorNew);}
                $somaLeiMensalAnoAnterior = array_sum($leiMensalAnoAnteriorNew);

                // ano atual (SOMA)
                $leiMensalAnoAtualNew = array_value_recursive('mes'.$mes, $leiMensalAnoAtual);
                if($leiMensalAnoAtualNew == null){$leiMensalAnoAtualNew = array(0);}
                if(!is_array($leiMensalAnoAtualNew)){$leiMensalAnoAtualNew = array($leiMensalAnoAtualNew);}
                $somaLeiMensalAnoAtual = array_sum($leiMensalAnoAtualNew);

                if($mes == 1){

                    // mes 12 ano anterior do ano anterior - (SOMA)
                    if(!is_array($leiMensalAnoAnteriorNew)){$leiMensalAnoAnteriorNew = array($leiMensalAnoAnteriorNew);}
                    $somaLeiMensalAnoAnterior_1 = array_sum($leiMensalAnoAnteriorNew); // OBS CONSERTAR (ano anterior do ano anterior nao existe)

                    // mes 12 ano anterior - (SOMA)
                    $somaLeiMensalAnoAtual_1New = array_value_recursive('mes12', $leiMensalAnoAnterior);
                    if($somaLeiMensalAnoAtual_1New == null){$somaLeiMensalAnoAtual_1New = array(0);}
                    if(!is_array($somaLeiMensalAnoAtual_1New)){$somaLeiMensalAnoAtual_1New = array($somaLeiMensalAnoAtual_1New);}
                    $somaLeiMensalAnoAtual_1 = array_sum($somaLeiMensalAnoAtual_1New);

                }else{

                    // - 1mes - ano anterior - (SOMA)
                    $somaLeiMensalAnoAnterior_1New = array_value_recursive('mes'.($mes - 1), $leiMensalAnoAnterior);
                    if($somaLeiMensalAnoAnterior_1New == null){$somaLeiMensalAnoAnterior_1New = array(0);}
                    if(!is_array($somaLeiMensalAnoAnterior_1New)){$somaLeiMensalAnoAnterior_1New = array($somaLeiMensalAnoAnterior_1New);}
                    $somaLeiMensalAnoAnterior_1 = array_sum($somaLeiMensalAnoAnterior_1New);

                    // - 1mes - ano atual - (SOMA)
                    $somaLeiMensalAnoAtual_1New = array_value_recursive('mes'.($mes - 1), $leiMensalAnoAtual);
                    if($somaLeiMensalAnoAtual_1New == null){$somaLeiMensalAnoAtual_1New = array(0);}
                    if(!is_array($somaLeiMensalAnoAtual_1New)){$somaLeiMensalAnoAtual_1New = array($somaLeiMensalAnoAtual_1New);}
                    $somaLeiMensalAnoAtual_1 = array_sum($somaLeiMensalAnoAtual_1New);

                }

                //CONSUMO MEDIA MENSAL
                $consumoCalAnt = $somaLeiMensalAnoAnterior - $somaLeiMensalAnoAnterior_1;
                $consumoCalAtual = $somaLeiMensalAnoAtual - $somaLeiMensalAnoAtual_1;

                array_push($somaConsumoAnoAnterior, $consumoCalAnt);
                array_push($somaConsumoAnoAtual, $consumoCalAtual);
            }
        }// fim - calculos..

        // GRAFICO CONSUMO MENSAL (TYPE: LINE)
        $chartConsumoLine = new ConsumoCharts;
        $chartConsumoLine->title("Media Consumo Mensal do Imovel");
        $chartConsumoLine->labels(['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ']);
        $chartConsumoLine->dataset($anoAnterior, 'line', $somaConsumoAnoAnterior)->backgroundcolor('#3c8dbc');
        $chartConsumoLine->dataset($anoAtual, 'line', $somaConsumoAnoAtual)->backgroundcolor('#ffcc00');
        // FIM - GRAFICO CONSUMO MENSA (TYPE: LINE)

        return $chartConsumoLine;
    }

    public function lista(Cidade $cidade)
    {

        $retorno = [];

        if(app('defender')->hasRoles('Administrador'))
            $imoveis =  Imovel::with('endereco:id,bairro')->byCidade($cidade->id);
        else
            $imoveis =  Imovel::where('id', auth()->user()->imovel_id)->get();
            
            
        foreach($imoveis as $imovel) {

            $retorno[] = [
                'id' => $imovel->id,
                'foto' => $imovel->foto,
                'capa' => $imovel->capa,
                'nome' => $imovel->nome,
                'bairro' => $imovel->endereco->bairro,
                'agrupamentos' => $imovel->agrupamento()->count(),
                'unidades' => $imovel->unidade()->count(),
                'prumadas' => Prumada::byImovel($imovel->id)->count()
            ];

        }

        return $retorno;
    }

    public function leituraUnidade(Prumada $prumada)
    {
        $prumada = Prumada::with('unidade.imovel', 'unidade.agrupamento')->find($prumada->id);

        if(app('defender')->hasRoles(['Sindico', 'Secretário']) && auth()->user()->imovel_id !== $prumada->unidade->imovel_id){
            return abort(403, 'Você não tem permissão');
        }

        $response = Curl::to(
            "http://{$prumada->unidade->imovel->host}/api/leitura/".dechex($prumada->funcional_id).$prumada->repetidor
        )->get();
        
        $leitura = converter_leitura($prumada->funcional_id, $response ?? [], $response ?? []);

        if(empty($leitura->erro) and $leitura) {

            Leitura::create([
                'prumada_id' => $prumada->id,
                'metro' => $leitura->m3,
                'litro' => $leitura->litros,
                'mililitro' => $leitura->decilitros,
                'valor' => $leitura->valor,
            ]);

            Session::flash('success', 'Leitura realizada com sucesso.' );
            return redirect("imovel/buscar/ver/{$prumada->unidade->imovel->id}?a={$prumada->unidade->agrupamento->id}");
        } else {
            $prumada->status = 0;
            $prumada->save();
            Session::flash('error', 'Leitura não pode ser realizada. Por favor, verifique a conexão.' );

            return redirect('imovel/buscar/ver/'.$prumada->unidade->imovel->id.'?a='.$prumada->unidade->agrupamento->id);

        }

    }

    public function atualizarTodasLeituraUnidade($id)
    {
        $user = auth()->user()->USER_IMOID;
        if(app('defender')->hasRoles(['Sindico', 'Secretário']) && !($user == $id)){
            return view('error403');
        }

        $imovel = Imovel::find($id);

        /*foreach ($imovel as $imo) {*/
        $unidades = Imovel::find($id)->getUnidades;
        foreach ($unidades as $unid)
        {
            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
            foreach ($prumadas as $prumada)
            {
                $curl = curl_init();
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'http://'.$prumada->unidade->imovel->IMO_IP.'/api/leitura/'.dechex($prumada->PRU_IDFUNCIONAL),
                    CURLOPT_CONNECTTIMEOUT => 15,
                    CURLOPT_TIMEOUT        => 15,
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
                ));

                // Send the request & save response to $resp
                $resp = curl_exec($curl);
                // Close request to clear up some resources
                curl_close($curl);

                $jsons = json_decode($resp);

                //var_dump($jsons);
                //echo "<br/>";
                if(($jsons !== NULL ) && (count($jsons) > 13) && ($jsons['0'] !== '!'))
                {
                    $metro_cubico = hexdec(''.$jsons['5'].''.$jsons['6'].'');

                    $litros = hexdec(''.$jsons['9'].''.$jsons['10'].'');

                    $mililitro = hexdec(''.$jsons['13'].''.$jsons['14'].'');

                    // var_dump($metro_cubico);
                    // var_dump($litros);
                    // var_dump($mililitro);

                    $subtotal = ($metro_cubico * 1000) + $litros;
                    $total = $subtotal.'.'.$mililitro.'';

                    $leitura = [
                        'LEI_IDPRUMADA' => $prumada->PRU_ID,
                        'LEI_METRO' => $metro_cubico,
                        'LEI_LITRO' => $litros,
                        'LEI_MILILITRO' => $mililitro,
                        'LEI_VALOR' => $total,
                    ];

                    Leitura::create($leitura);
                    Session::flash('success', 'Procedimento realizado com sucesso.' );

                }
                //                    else
                //                    {
                //                        Session::flash('error', 'Ação não pode ser realizada. Por favor, verifique a conexão.' );
                //                        return redirect('imovel/ver/'.$id);
                //                    }
            }
        }
        /*}*/

        return redirect('imovel/buscar/ver/'.$id);
    }

    public function ligarDesligarPrumada(Prumada $prumada, $comando)
    {
        $prumada = Prumada::with('unidade.imovel', 'unidade.agrupamento')->find($prumada->id);

        if(app('defender')->hasRoles('Sindico') && auth()->user()->imovel_id !== $prumada->unidade->imovel_id)
            return view('error403');

        $response = json_decode(
            Curl::to("http://{$prumada->unidade->imovel->host}/api/{$comando}/".dechex($prumada->funcional_id).$prumada->unidade->agrupamento->repetidor)->get()
        );

        if($response) {
            //  if (prumada_status($response) == '00')
            //     $prumada->status = 1;
                
            // else
            //     $prumada->status = 0;

            if ($comando == 'ativacao')
                $prumada->status = 1;
            else
                $prumada->status = 0;

            $prumada->save();

            $string = $comando == 'ativacao' ? 'ligado' : 'desligado';

            return redirect("imovel/buscar/ver/{$prumada->unidade->imovel_id}?a={$prumada->unidade->agrupamento_id}")
                ->withSuccess("Equipamento {$string} com sucesso.");
        } else {
            $prumada->update(['status' => '0']);

            return redirect("imovel/buscar/ver/{$prumada->unidade->imovel_id}?a={$prumada->unidade->agrupamento_id}")
                ->withError('Ação não pode ser realizada. Por favor, verifique a conexão.');
        }

    }

    public function agrupamento($imovel_id)
    {
        return Agrupamento::whereImovelId($imovel_id)->pluck('nome', 'id');
    }

    public function unidade($imovel_id)
    {
        return Unidade::whereImovelId($imovel_id)->pluck('nome', 'id');
    }
}
