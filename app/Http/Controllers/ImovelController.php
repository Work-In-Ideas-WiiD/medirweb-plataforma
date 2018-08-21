<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imovel;

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
        //
        return view('imovel.listar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('imovel.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'imo_nome' => 'required',
        ]);

       $imovel = new Imovel;
       $imovel->IMO_NOME = $request->input('imo_nome');
       $imovel->IMO_ENDERECO = $request->input('imo_endereco');
       $imovel->IMO_COMPLEMENTO = $request->input('imo_complemento');
       $imovel->IMO_NUMERO = $request->input('imo_numero');
       $imovel->IMO_BAIRRO = $request->input('imo_bairro');
       $imovel->IMO_IDCIDADE = $request->input('imo_idcidade');
       $imovel->IMO_IDESTADO = $request->input('imo_idestado');
       $imovel->IMO_CEP = $request->input('imo_cep');
       $imovel->IMO_RESPONSAVEIS = $request->input('imo_responsaveis');
       $imovel->IMO_TELEFONES = $request->input('imo_telefones');
       $imovel->save();

       return redirect('/imovel/cadastrar')->with('success', 'Imóvel cadastrado com sucesso.');

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
        /* -------------------------------------------------------------------------------- */

        return view('imovel.visualizar', ['imovel' => $imovel, 'agrupamentos' => $agrupamentos, 'unidades' => $unidades]);
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

        return view('imovel.editar', compact('imovel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imovel = Imovel::findOrFail($id);

        if(is_null($imovel)){
            return redirect( URL::previous() );
        }

        $dataForm = $request->all();

        $imovel->update($dataForm);

        return redirect('imovel/ver/'. $imovel->IMO_ID);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
                'IMO_ID' => $imo->IMO_ID,
                'IMO_NOME' => $imo->IMO_NOME,
                'IMO_BAIRRO' => $imo->IMO_BAIRRO
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
                CURLOPT_URL => 'http://18.208.209.113/hidromed/leituraID.php?id='.$prumada->PRU_ID,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);

            $jsons = json_decode($resp);

            //var_dump($jsons);

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

        return redirect('imovel/ver/'.$imovel->IMO_ID);
    }

    public function atualizarTodasLeituraUnidade()
    {
        $imovel = Imovel::all();

        foreach ($imovel as $key => $imo) {
            $unidades = $imo->getUnidades();
            foreach ($unidades as $unidade)
            {
                foreach ($unidade->getPrumadas as $prumada)
                {
                    $curl = curl_init();
                        // Set some options - we are passing in a useragent too here
                        curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'http://18.208.209.113/hidromed/leituraID.php?id='.$prumada->PRU_ID,
                        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
                    ));
                    
                    // Send the request & save response to $resp
                    $resp = curl_exec($curl);
                    // Close request to clear up some resources
                    curl_close($curl);

                    $jsons = json_decode($resp);

                    //var_dump($jsons);

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
            }
        }

        return redirect('imovel/ver/1');
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
                CURLOPT_URL => 'http://18.208.209.113/hidromed/abrir.php?id='.$prumada->PRU_ID,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);

            $jsons = json_decode($resp);

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

        return redirect('imovel/ver/'.$imovel->IMO_ID);
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
                CURLOPT_URL => 'http://18.208.209.113/hidromed/fechar.php?id='.$prumada->PRU_ID,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);

            $jsons = json_decode($resp);

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

        return redirect('imovel/ver/'.$imovel->IMO_ID);
    }
}

