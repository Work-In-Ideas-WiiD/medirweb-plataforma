<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Imovel\ImovelSaveRequest;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Leitura;
use Session;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Imovel\ImovelEditRequest;


class ImovelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imoveis = Imovel::get();

        return view('imovel.listar', compact('imoveis'));
    }

    public function buscar()
    {
        $estados = ['' => 'Selecionar Estado'];
        $_estados = Estado::all();
        foreach($_estados as $estado)
            $estados[$estado->EST_ID] = $estado->EST_NOME;

        //
        return view('imovel.buscar_listar', compact( 'estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = ['' => 'Selecionar Cliente'];
        $_clientes = Cliente::where('CLI_STATUS', 1)->get();
        foreach($_clientes as $cliente)
            $clientes[$cliente->CLI_ID] = $cliente->CLI_NOMEJUR;

        $estados = ['' => 'Selecionar Estado'];
        $_estados = Estado::all();
        foreach($_estados as $estado)
            $estados[$estado->EST_ID] = $estado->EST_NOME;

        return view('imovel.cadastrar', compact('clientes', 'estados'));
    }

    public function showCidades($id)
    {
        $cidades =  Cidade::where('CID_IDESTADO', $id)->get();

        if(is_null($cidades)){
            return redirect( URL::previous() );
        }


        return json_encode($cidades);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImovelSaveRequest $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imovel =  Imovel::findorFail($id);

        $imovel['IMO_IDCIDADE'] = Imovel::find($id)->cidade->CID_NOME;
        $imovel['IMO_IDESTADO'] = Imovel::find($id)->estado->EST_ABREVIACAO;

        $agrupamentos = $imovel->getAgrupamentos;

        $unidades =  $imovel->getUnidades;

        return view('imovel.visualizar', compact('agrupamentos', 'imovel', 'unidades'));
    }


    public function show_buscar($id)
    {
        $imovel =  Imovel::findorFail($id);

        $imovel['IMO_IDCIDADE'] = Imovel::find($id)->cidade->CID_NOME;
        $imovel['IMO_IDESTADO'] = Imovel::find($id)->estado->EST_ABREVIACAO;

        $agrupamentos = Imovel::find($id)->getAgrupamentos;
        $unidades = Imovel::findorFail($id)->getUnidades;

        // Ajuste para a criação de abas na view de forma correta
        $agrupamentos = $agrupamentos->reverse();

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

        /* -------------------------------------------------------------------------------- */
        /* Adicionar UNIDADES de cada um dos agrupamentos e chamar a variavel de $unidades  */
        /* Adicionar  de cada uma das unidades, a variável $unidade->ULT_LEITURA com        */
        /* o último valor de leitura daquela unidade.                                       */
        /* -----------------------------------------visualizar-v1--------------------------------------- */

        //return view('imovel.visualizar-v1', ['imovel' => $imovel, 'agrupamentos' => $agrupamentos, 'unidades' => $unidades]);

        return view('imovel.buscar_visualizar', ['imovel' => $imovel, 'agrupamentos' => $agrupamentos, 'unidades' => $unidades]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImovelEditRequest $request, $id)
    {
        $imovel = Imovel::findOrFail($id);

        if(is_null($imovel)){
            return redirect( URL::previous() );
        }

        if($request->hasFile('foto')){
            $foto_path = public_path("upload/fotos/".$imovel->IMO_FOTO);

            if (File::exists($foto_path)) {
                File::delete($foto_path);
            }

            $fileName = md5(uniqid().str_random()).'.'.$request->file('foto')->extension();
            $dataForm['IMO_FOTO'] = $request->file('foto')->move('upload/fotos', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/fotos/'.$dataForm['IMO_FOTO']);
        } else
            $request->offsetUnset('foto');

        if($request->hasFile('capa')){
            $capa_path = public_path("upload/capas/".$imovel->IMO_FOTO);

            if (File::exists($capa_path)) {
                File::delete($capa_path);
            }

            $fileName = md5(uniqid().str_random()).'.'.$request->file('capa')->extension();
            $dataForm['IMO_CAPA'] = $request->file('capa')->move('upload/capas', $fileName)->getFilename();

            ImageOptimizer::optimize('upload/capas/'.$dataForm['IMO_CAPA']);
        } else
            $request->offsetUnset('capa');

        $dataForm = $request->all();

        $imovel->update($dataForm);

        return redirect('imovel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
       Imovel::destroy($id);

       $request->session()->flash('message-success', 'Administrador deletado com sucesso!');
       return redirect()->route('Listar Imóveis');
     }

    public function getImoveisLista(Request $request)
    {
        //return $request->IMO_IDESTADO;
        $imoveis =  Imovel::where('IMO_IDESTADO', $request->IMO_IDESTADO)
                            ->where('IMO_IDCIDADE', $request->IMO_IDCIDADE)
                            ->get();

        $retorno = array();
        foreach($imoveis as $imo)
        {
            $retorno[] = [
                'IMO_ID'        => $imo->IMO_ID,
                'IMO_FOTO'      => $imo->IMO_FOTO,
                'IMO_CAPA'      => $imo->IMO_CAPA,
                'IMO_NOME'      => $imo->IMO_NOME,
                'IMO_BAIRRO'    => $imo->IMO_BAIRRO,
                'AGR'           => $imo->getAgrupamentos->count(),
                'UNI'           => $imo->getUnidades->count(),
                //'EQP'           => $imo->getUnidades->getEquipamentos->count()
            ];
        }

        //dd($imoveis);
        return response()->json(['imoveis'=>$retorno]);
    }

    public function leituraUnidade($imovel, $unidade)
    {
        $imovel = Imovel::find($imovel);

        $unidade = Unidade::find($unidade);

        //var_dump($unidade->getPrumadas); die();
        foreach ($unidade->getPrumadas as $prumada)
        {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://192.168.130.4/api/leitura/'.dechex($prumada->PRU_ID),
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
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
            }
            else
            {
                $prumada->PRU_STATUS = 0;
                $prumada->save();
                Session::flash('error', 'Leitura não pode ser realizada. Por favor, verifique a conexão.' );
            }

        }

        return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
        //return redirect::back();
    }

    public function atualizarTodasLeituraUnidade($id)
    {
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
                        CURLOPT_URL => 'http://192.168.130.4/api/leitura/'.dechex($prumada->PRU_ID),
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
        $imovel = Imovel::find($imovel);

        $unidade = Unidade::find($unidade);

        //var_dump($unidade->getPrumadas); die();
        foreach ($unidade->getPrumadas as $prumada)
        {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://192.168.130.4/api/ativacao/'.dechex($prumada->PRU_ID),
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
            }
            else
            {
                $prumada->PRU_STATUS = 0;
                $prumada->save();
                Session::flash('error', 'Ação não pode ser realizada. Por favor, verifique a conexão.' );
            }


        }

        return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
    }

    public function desligarUnidade($imovel, $unidade)
    {
        $imovel = Imovel::find($imovel);

        $unidade = Unidade::find($unidade);

        //var_dump($unidade->getPrumadas); die();
        foreach ($unidade->getPrumadas as $prumada)
        {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://192.168.130.4/api/corte/'.dechex($prumada->PRU_ID),
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
            }
            else
            {
                $prumada->PRU_STATUS = 1;
                $prumada->save();
                Session::flash('error', 'Ação não pode ser realizada. Por favor, verifique a conexão.' );
            }

        }

        return redirect('imovel/buscar/ver/'.$imovel->IMO_ID);
    }
}
