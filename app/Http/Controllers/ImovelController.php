<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Cliente;
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
use Session;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\File;
use App\Charts\ConsumoCharts;


class ImovelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $user = auth()->user()->USER_IMOID;

        if(app('defender')->hasRoles('Administrador')){
            $imoveis = Imovel::get();
        }else if(app('defender')->hasRoles(['Sindico', 'Secretário'])){
            $imoveis = Imovel::get()->where('IMO_ID', $user);
        }else{
            return view('error403');
        }

        return view('imovel.listar', compact('imoveis'));
    }

    public function buscar()
    {
        $estados = ['' => 'Selecionar Estado'];
        $_estados = Estado::all();
        foreach($_estados as $estado)
        $estados[$estado->EST_ID] = $estado->EST_NOME;

        return view('imovel.buscar_listar', compact( 'estados'));
    }

    public function create()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $clientes = ['' => 'Selecionar Cliente'];
        $_clientes = Cliente::where('CLI_STATUS', 1)->get();
        foreach($_clientes as $cliente)
        $clientes[$cliente->CLI_ID] = $cliente->CLI_NOMEJUR;

        $estados = ['' => 'Selecionar Estado'];
        $_estados = Estado::all();
        foreach($_estados as $estado)
        $estados[$estado->EST_ID] = $estado->EST_NOME;

        $mes = array();
        $mes = ['' => 'Selecione'];
        for ($i = 1; $i <= 31; $i++){
            array_push($mes, $i);
        }

        return view('imovel.cadastrar', compact('clientes', 'estados', 'mes'));
    }

    public function showCidades($id)
    {
        $cidades =  Cidade::where('CID_IDESTADO', $id)->get();

        if(is_null($cidades)){
            return redirect( URL::previous() );
        }

        return json_encode($cidades);
    }

    public function store(ImovelSaveRequest $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $dataForm = $request->all();

        if($request->hasFile('foto')){
            $fileName = md5(uniqid().str_random()).'.'.$request->file('foto')->extension();
            $dataForm['IMO_FOTO'] = $request->file('foto')->move('upload/fotos', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/fotos/'.$dataForm['IMO_FOTO']);
        }

        if($request->hasFile('capa')){
            $fileName = md5(uniqid().str_random()).'.'.$request->file('capa')->extension();
            $dataForm['IMO_CAPA'] = $request->file('capa')->move('upload/capas', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/capas/'.$dataForm['IMO_CAPA']);
        }

        $imovel = Imovel::create($dataForm);

        return redirect('/imovel/ver/'.$imovel->IMO_ID)->with('success', 'Imóvel cadastrado com sucesso.');

    }

    public function show($id)
    {
        $user = auth()->user()->USER_IMOID;
        if(!app('defender')->hasRoles('Administrador') && !($user == $id)){
            return view('error403');
        }

        $imovel =  Imovel::findorFail($id);

        $imovel['IMO_IDCIDADE'] = Imovel::find($id)->cidade->CID_NOME;
        $imovel['IMO_IDESTADO'] = Imovel::find($id)->estado->EST_ABREVIACAO;

        $agrupamentos = $imovel->getAgrupamentos;
        $unidades =  $imovel->getUnidades;

        $chartConsumoLine = ImovelController::graficoConsumoGeral($id);

        return view('imovel.visualizar', compact('agrupamentos', 'imovel', 'unidades', 'chartConsumoLine'));
    }


    public function show_buscar($id)
    {
        $user = auth()->user()->USER_IMOID;
        if(!app('defender')->hasRoles('Administrador') && !($user == $id)){
            return view('error403');
        }

        if($id == 4 )
        {
            return redirect('teste/'.$id);
        }

        $imovel =  Imovel::findorFail($id);

        $imovel['IMO_IDCIDADE'] = Imovel::find($id)->cidade->CID_NOME;
        $imovel['IMO_IDESTADO'] = Imovel::find($id)->estado->EST_ABREVIACAO;

        $agrupamentos = Imovel::find($id)->getAgrupamentos;
        $unidades = Imovel::findorFail($id)->getUnidades;

        // Ajuste para a criação de abas na view de forma correta
        //$agrupamentos = $agrupamentos->reverse();

        $unid = array();

        foreach ($agrupamentos as $key => $agrup) {
            foreach($unidades as $uni)
            {
                if($uni->UNI_IDAGRUPAMENTO == $agrup->AGR_ID)
                {
                    array_push($unid, $uni);
                }
            }
            if(count($unid) > 0)
            {
                $agrup->UNIDADES = $unid;
                $unid = [];
            }
            else
            {
                $agrup->UNIDADES = null;
            }
        }

        $chartConsumoLine = ImovelController::graficoConsumoGeral($id);

        return view('imovel.buscar_visualizar', ['imovel' => $imovel, 'agrupamentos' => $agrupamentos, 'unidades' => $unidades, "chartConsumoLine" => $chartConsumoLine]);
    }

    public function edit($id)
    {
        $user = auth()->user()->USER_IMOID;
        if(app('defender')->hasRoles('Sindico') && !($user == $id)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        $imovel = Imovel::findOrFail($id);

        if(is_null($imovel)){
            return redirect( URL::previous() );
        }

        $clientes = ['' => 'Selecionar Cliente'];
        $_clientes = Cliente::where('CLI_STATUS', 1)->get();
        foreach($_clientes as $cliente)
        $clientes[$cliente->CLI_ID] = $cliente->CLI_NOMEJUR;

        $estados = ['' => 'Selecionar Estado'];
        $_estados = Estado::all();
        foreach($_estados as $estado)
        $estados[$estado->EST_ID] = $estado->EST_NOME;

        $cidades = ['' => 'Selecionar Estado'];
        $_cidades = Cidade::where('CID_IDESTADO', $imovel->IMO_IDESTADO)->get();
        foreach($_cidades as $cidade)
        $cidades[$cidade->CID_ID] = $cidade->CID_NOME;

        return view('imovel.editar', compact('imovel', 'clientes', 'estados', 'cidades'));
    }


    public function update(ImovelEditRequest $request, $id)
    {
        $user = auth()->user()->USER_IMOID;
        if(app('defender')->hasRoles('Sindico') && !($user == $id)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        $imovel = Imovel::findOrFail($id);

        if(is_null($imovel)){
            return redirect( URL::previous() );
        }

        if($request->IMO_IDCLIENTE){
            return redirect('/imovel/editar/'.$imovel->IMO_ID)->with('error', 'Não é permitido burlar o sistema!');
        }

        if($request->IMO_FATURACICLO){
            return redirect('/imovel/editar/'.$imovel->IMO_ID)->with('error', 'Não é permitido burlar o sistema!');
        }

        $dataForm = $request->all();

        if($request->hasFile('foto')){
            $foto_path = public_path("upload/fotos/".$imovel->IMO_FOTO);

            if (File::exists($foto_path)) {
                File::delete($foto_path);
            }

            $fileName = md5(uniqid().str_random()).'.'.$request->file('foto')->extension();
            $dataForm['IMO_FOTO'] = $request->file('foto')->move('upload/fotos', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/fotos/'.$dataForm['IMO_FOTO']);
        }
        if($request->hasFile('capa')){
            $capa_path = public_path("upload/capas/".$imovel->IMO_FOTO);

            if (File::exists($capa_path)) {
                File::delete($capa_path);
            }

            $fileName = md5(uniqid().str_random()).'.'.$request->file('capa')->extension();
            $dataForm['IMO_CAPA'] = $request->file('capa')->move('upload/capas', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/capas/'.$dataForm['IMO_CAPA']);
        }

        $imovel->update($dataForm);

        return redirect('/imovel/ver/'.$imovel->IMO_ID)->with('success', 'Imóvel atualizado com sucesso.');
    }

    public function destroy(Request $request, $id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        Imovel::destroy($id);

        return redirect('imovel')->with('success', 'Imovel deletado com sucesso!');
    }


    public function getLancarConsumo($id)
    {
        $user = auth()->user()->USER_IMOID;
        if(app('defender')->hasRoles('Sindico') && !($user == $id)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        $imovel = Imovel::findOrFail($id);

        $mesCiclo = array();
        for ($i = ($imovel->IMO_FATURACICLO - 5); $i <= ($imovel->IMO_FATURACICLO + 5); $i++){
            if($i <= date("d")){
                $mesCiclo += [ date('Y-m-d', strtotime(date("Y-m")."-".$i))  => $i ];
            }
        }

        $faturas = Fatura::where('FAT_IMOID', $id)->whereMonth('FAT_DTLEIFORNECEDOR', date("m"))->get();
        $ciclo =  $imovel->IMO_FATURACICLO - date("d");

        if($ciclo >= -5 &&  $ciclo <= 5){

            foreach ($faturas as $fatura) {
                $mesLeiFornecedor = date('Y-m', strtotime($fatura->FAT_DTLEIFORNECEDOR));

                if($mesLeiFornecedor == date("Y-m")){
                    return view('imovel.lancarConsumo', compact('faturas'));
                }
            }

            return view('imovel.lancarConsumo', compact('mesCiclo', 'id'));
        }else {
            return redirect('imovel')->with('error', 'Imovel "'.$imovel->IMO_NOME.'", esta fora do ciclo para lançamento do Consumo Mensal!');
        }

        return redirect('imovel')->with('error', 'error desconhecido!');
    }


    public function postLancarConsumo(LancarConsumoRequest $request)
    {
        $user = auth()->user()->USER_IMOID;
        if(app('defender')->hasRoles('Sindico') && !($user == $id)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        // validação se o usuario tentar burlar o sistema
        // (DATA DA LEITURA)
        if (!(date('Y-m', strtotime($request->FAT_DTLEIFORNECEDOR)) == date('Y-m'))) {
            return redirect('/imovel')->with('error', 'Não é permitido burlar o sistema!');
        }

        // FORA DO CICLO
        $ciclo = date('d', strtotime($request->FAT_DTLEIFORNECEDOR)) - date('d');
        if(!($ciclo >= -5 &&  $ciclo <= 5)){
            return redirect('/imovel')->with('error', 'Não é permitido burlar o sistema!');
        }

        // ENVIAR INFORMAÇÕES MAIS DE UMA VEZ
        $faturasValidation = Fatura::where('FAT_IMOID', $request->FAT_IMOID)->whereMonth('FAT_DTLEIFORNECEDOR', date("m"))->get();
        foreach ($faturasValidation as $value) {
            $result = date('Y-m', strtotime($value->FAT_DTLEIFORNECEDOR));
            if($result  == date("Y-m")){
                return redirect('/imovel')->with('error', 'ATENÇÃO! Este mês já foi coletado o consumo mensal do fornecedor! Não é permitido adicionar novamente!');
            }
        }
        // FIM VALIDAÇÃO

        $dataForm = $request->all();

        // Formatação ponto e virgula do valor que veio no formulario
        $formatarLeiMetroValorFor1 = str_replace(".", "", $dataForm['FAT_LEIMETRO_VALORFORNECEDOR']);
        $formatarLeiMetroValorFor = str_replace(",", ".", $formatarLeiMetroValorFor1);
        // fim - Formatação...


        // ##### *INICIO - PEGANDO TODAS LEITURAS DAS UNIDADES e SOMANDO E FAZENDO MEDIA DO MES ATUAL* #####
        $menos1mes = date("Y-m", strtotime('-1 month'));
        $leituraAtual = array();
        $leituraAnterior = array();
        $leiMetroFornecedorAnterior = 0;

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

                //LEITURA DO MES ANTERIOR
                $getLeituraAnterior = $prumada->getLeituras()->where('created_at', '<=', date("Y-m-d", strtotime($menos1mes."-".$prumada->unidade->imovel->IMO_FATURACICLO)).' 23:59:59')
                ->orderBy('created_at', 'desc')->first();
                $arrayLeituraAnterior = $getLeituraAnterior['LEI_METRO'];
                array_push($leituraAnterior, $arrayLeituraAnterior);
                // fim - LEITURA DO MES ANTERIOR

                // LEITURA DO MES ATUAL
                $getLeituraAtual = $prumada->getLeituras()->where('created_at', '<=', date("Y-m-d", strtotime($request->FAT_DTLEIFORNECEDOR)).' 23:59:59')
                ->orderBy('created_at', 'desc')->first();
                $arrayLeituraAtual = $getLeituraAtual['LEI_METRO'];
                array_push($leituraAtual, $arrayLeituraAtual);
                // fim - LEITURA DO MES ATUAL
            }

        }// FIM - BUSCAS

        // mes anterior (SOMA)
        $leituraAnteriorInteger = array_map(function($value){return (int)$value;},$leituraAnterior);
        if(!is_array($leituraAnteriorInteger)){$leituraAnteriorInteger = array($leituraAnteriorInteger);}
        $somaLeituraAnterior = array_sum($leituraAnteriorInteger);
        // fim - mes anterior

        // mes atual (SOMA)
        $leituraAtualInteger = array_map(function($value){return (int)$value;},$leituraAtual);
        if(!is_array($leituraAtualInteger)){$leituraAtualInteger = array($leituraAtualInteger);}
        $somaLeituraAtual = array_sum($leituraAtualInteger);
        // fim - mes atual

        // LEITURA DE TODAS AS UNIDADES DO MES ATUAL
        //$somaLeituraAtual = 20;
        $dataForm['FAT_LEIMETRO_UNI'] = $somaLeituraAtual;

        // VERIFICANDO SE NO MES ANTERIOR FOI ADICIONADO O CONSUMO (SE MES ANTERIOR FOI ADIONADO ENTÃO VAI RECEBER O VALOR QUE ESTA NO BANCO)
        $faturas = Fatura::where('FAT_IMOID', $dataForm['FAT_IMOID'])->whereMonth('FAT_DTLEIFORNECEDOR', date("m", strtotime('-1 month')) )->get();
        foreach ($faturas as $fatura) {
            $mesLeiFornecedor = date('Y-m', strtotime($fatura->FAT_DTLEIFORNECEDOR));

            if($mesLeiFornecedor == date("Y-m", strtotime('-1 month'))){
                $somaLeituraAnterior = $fatura->FAT_LEIMETRO_UNI;
                $leiMetroFornecedorAnterior = $fatura->FAT_LEIMETRO_FORNECEDOR;
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
        $valorConsumoUnidades = $resultado / $ConsumoFornecedor;
        $valorConsumoImovel =  $formatarLeiMetroValorFor - $valorConsumoUnidades;
        // FIM

        $dataForm['FAT_CONSUMO_VALORUNI'] = number_format($valorConsumoUnidades, 2, ',', '.');
        $dataForm['FAT_CONSUMO_VALORIMOVEL'] = number_format($valorConsumoImovel, 2, ',', '.');


        //Testes
        //echo "Leitura Anterior do Fornecedor: ".$leiMetroFornecedorAnterior."<br>";
        //echo "Leitura Anterior das Unidades: ".$somaLeituraAnterior."<br>";  // teste
        //echo "Leitura Atual das Unidades: ".$somaLeituraAtual."<hr>";        // teste

        //echo "<br>Consumo Mes Atual: ".$consumoUnidades."<hr>";      // teste


        //echo "<br> VALOR CONSUMO UNIDADES: ".$dataForm['FAT_CONSUMO_VALORUNI']; //teste
        //echo "<br> VALOR CONSUMO IMOVEL: ".$dataForm['FAT_CONSUMO_VALORIMOVEL']."<hr>"; //teste


        //foreach ($dataForm as $key => $value) {
        //    echo $key.": ".$value."<br><br>";
        //}
        //die;
        // fim - testes


        Fatura::create($dataForm);

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
        $apartamentos = Imovel::find($id)->getUnidades;
        foreach ($apartamentos as $unid) {
            $prumadas = Unidade::find($unid->UNI_ID)->getPrumadas;
            foreach ($prumadas as $prumada){
            }

            // TODAS AS LEITURAS DE TODOS OS EQUIPAMENTOS SEPARADOS MENSALMENTE
            for ($mes=1; $mes <= 12; $mes++) {

                $leituraAnoAnterior = $prumada->getLeituras() ->where('created_at', '<=', date("Y-m-d", strtotime($anoAnterior."-".$mes."-31")).' 23:59:59')
                ->orderBy('created_at', 'desc')->first();

                $leituraAnoAtual = $prumada->getLeituras() ->where('created_at', '<=', date("Y-m-d", strtotime($anoAtual."-".$mes."-31")).' 23:59:59')
                ->orderBy('created_at', 'desc')->first();

                $arrayLeiMensalAnoAnterior = array('mes' => array('mes'.$mes => $leituraAnoAnterior['LEI_METRO']));
                $arrayLeiMensalAnoAtual = array('mes' => array('mes'.$mes => $leituraAnoAtual['LEI_METRO']));

                array_push($leiMensalAnoAnterior, $arrayLeiMensalAnoAnterior);
                array_push($leiMensalAnoAtual, $arrayLeiMensalAnoAtual);
            }// fim - TODAS AS LEITUAS ...
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

    public function getImoveisLista(Request $request)
    {

        if(app('defender')->hasRoles('Administrador')){
            $imoveis =  Imovel::where('IMO_IDESTADO', $request->IMO_IDESTADO)
            ->where('IMO_IDCIDADE', $request->IMO_IDCIDADE)
            ->get();
        }else{
            $user = auth()->user()->USER_IMOID;
            $imoveis =  Imovel::where('IMO_IDESTADO', $request->IMO_IDESTADO)
            ->where('IMO_IDCIDADE', $request->IMO_IDCIDADE)
            ->find($user);
        }

        $retorno = array();
        foreach($imoveis as $imo)
        {
            if(!(app('defender')->hasRoles('Administrador'))){
                $imo = $imoveis;
            }

            $retorno[] = [
                'IMO_ID'        => $imo->IMO_ID,
                'IMO_FOTO'      => $imo->IMO_FOTO,
                'IMO_CAPA'      => $imo->IMO_CAPA,
                'IMO_NOME'      => $imo->IMO_NOME,
                'IMO_BAIRRO'    => $imo->IMO_BAIRRO,
                'AGR'           => $imo->getAgrupamentos->count(),
                'UNI'           => $imo->getUnidades->count(),
                //'PRU'           => $imo->getUnidades->getPrumadas->count(),
            ];

            if(!(app('defender')->hasRoles('Administrador'))){
                break;
            }
        }

        return response()->json(['imoveis'=>$retorno]);
    }

    public function leituraUnidade($imovel, $unidade)
    {
        $user = auth()->user()->USER_IMOID;
        if(app('defender')->hasRoles(['Sindico', 'Secretário']) && !($user == $imovel)){
            return view('error403');
        }

        $imovel = Imovel::find($imovel);

        //$unidade = Unidade::find($unidade);
        $prumada = Prumada::find($unidade);

        //var_dump($unidade->getPrumadas); die();
        //        foreach ($unidade->getPrumadas as $prumada)
        //        {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$prumada->unidade->imovel->IMO_IP.'/api/leitura/'.dechex($prumada->PRU_IDFUNCIONAL),
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        $jsons = json_decode($resp);

        if(($jsons !== NULL ) && (count($jsons) > 13) && ($jsons['0'] !== '!'))
        {
            $metro_cubico = hexdec(''.$jsons['5'].''.$jsons['6'].'');

            $litros = hexdec(''.$jsons['9'].''.$jsons['10'].'');

            $mililitro = hexdec(''.$jsons['13'].''.$jsons['14'].'');
            //
            //                var_dump($metro_cubico);
            //                var_dump($litros);
            //                var_dump($mililitro);

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

            Session::flash('success', 'Leitura realizada com sucesso.' );
            return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
        }
        else
        {
            $prumada->PRU_STATUS = 0;
            $prumada->save();
            Session::flash('error', 'Leitura não pode ser realizada. Por favor, verifique a conexão.' );

            return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
        }

        //        }


        //return redirect::back();
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

    public function ligarUnidade($imovel, $unidade)
    {
        $user = auth()->user()->USER_IMOID;
        if(app('defender')->hasRoles('Sindico') && !($user == $imovel)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }


        $imovel = Imovel::find($imovel);

        //        $unidade = Unidade::find($unidade);

        $prumada = Prumada::find($unidade);
        //var_dump($unidade->getPrumadas); die();
        //        foreach ($unidade->getPrumadas as $prumada)
        //        {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$prumada->unidade->imovel->IMO_IP.'/api/ativacao/'.dechex($prumada->PRU_IDFUNCIONAL),
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        $jsons = json_decode($resp);

        if($jsons !== NULL)
        {
            if($jsons[4] == '00')
            {
                $status = 1;
            }
            else
            {
                $status = 0;
            }


            $atualizacao = [
                'PRU_STATUS' => $status,
            ];

            $prumada->update($atualizacao);

            Session::flash('success', 'Equipamento ligado com sucesso.' );
            return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
        }
        else
        {
            $prumada->PRU_STATUS = 0;
            $prumada->save();
            Session::flash('error', 'Ação não pode ser realizada. Por favor, verifique a conexão.' );

            return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
        }


        //        }


    }

    public function desligarUnidade($imovel, $unidade)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $imovel = Imovel::find($imovel);

        //$unidade = Unidade::find($unidade);

        $prumada = Prumada::find($unidade);

        //var_dump($unidade->getPrumadas); die();
        //        foreach ($unidade->getPrumadas as $prumada)
        //        {
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$prumada->unidade->imovel->IMO_IP.'/api/corte/'.dechex($prumada->PRU_IDFUNCIONAL),
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        $jsons = json_decode($resp);

        if($jsons !== NULL)
        {
            if($jsons[4] == '00')
            {
                $status = '1';
            }
            else
            {
                $status = '0';
            }


            $atualizacao = [
                'PRU_STATUS' => $status,
            ];

            $prumada->update($atualizacao);

            Session::flash('success', 'Equipamento desligado com sucesso.' );
            return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
        }
        else
        {
            $prumada->PRU_STATUS = 1;
            $prumada->save();
            Session::flash('error', 'Ação não pode ser realizada. Por favor, verifique a conexão.' );

            return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
        }

        //        }


    }
}
