<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Leitura;
use App\Models\Agrupamento;
use App\Models\Imovel;
use App\Http\Requests\Unidade\UnidadeSaveRequest;

class UnidadeController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$imoveis  = Imovel::pluck('IMO_NOME', 'IMO_ID');

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel)
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;

        return view('unidade.cadastrar', ['imoveis' => $imoveis]);
    }

    public function showAgrupamento($id)
    {
        //$agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->pluck('AGR_NOME','AGR_ID')->toArray();

        $agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->get();

        if(is_null($agrupamentos)){
            return redirect( URL::previous() );
        }


        return json_encode($agrupamentos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadeSaveRequest $request)
    {

        $dataForm = $request->all();

        $undiade = Unidade::create($dataForm);

        return redirect('/imovel')->with('success', 'Unidade cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $unidade        = Unidade::findorFail($id);
        $prumadas       = Unidade::find($id)->getPrumadas;
        $agrupamento    = Unidade::find($id)->agrupamento;
        $imovel         = Unidade::find($id)->imovel;
        $leituras       = Leitura::where('LEI_IDPRUMADA',$id)
                            ->orderBy('LEI_ID', 'desc')
                            ->get();
        $ultimaleitura =  Leitura::where('LEI_IDPRUMADA',$id)
                            ->orderBy('LEI_ID', 'desc')
                            ->first();

        //$ultimaleitura  = Unidade::find($id)->getPrumadas()->lastest();

        return view('unidade.lista', ['agrupamento' => $agrupamento, 'unidade' => $unidade, 'imovel' => $imovel, 'prumadas' => $prumadas, 'leituras' => $leituras, 'ultimaleitura' => $ultimaleitura]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function leituraUnidade($undd)
    {
        $unidade = Unidade::find($undd);

        //var_dump($unidade->getPrumadas); die();
        foreach ($unidade->getPrumadas as $prumada)
        {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://52.15.197.19/medirweb/doLeitura.php?id='.$prumada->PRU_ID,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);

            $jsons = json_decode($resp);

            //var_dump($jsons);
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
            else
            {
                $prumada->PRU_STATUS = 0;
                $prumada->save();
                Session::flash('error', 'Leitura não pode ser realizada. Por favor, verifique a conexão.');
            }
            

        }

        return redirect('unidade/ver/'.$undd);
    }

    public function ligarUnidade($undd)
    {

        $unidade = Unidade::find($undd);

        //var_dump($unidade->getPrumadas); die();
        foreach ($unidade->getPrumadas as $prumada)
        {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://52.15.197.19/medirweb/doAtivacao.php?id='.$prumada->PRU_ID,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);

            $jsons = json_decode($resp);

            if(($jsons !== NULL ) && (count($jsons) > 13) && ($jsons['0'] !== '!'))
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
                Session::flash('error', 'Unidade não pode ser ligada. Por favor, verifique a conexão.');
            }

        }

        return redirect('unidade/ver/'.$undd);
    }

    public function desligarUnidade($undd)
    {

        $unidade = Unidade::find($undd);

        //var_dump($unidade->getPrumadas); die();
        foreach ($unidade->getPrumadas as $prumada)
        {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://52.15.197.19/medirweb/doCorte.php?id='.$prumada->PRU_ID,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
            // Close request to clear up some resources
            curl_close($curl);

            $jsons = json_decode($resp);

            if(($jsons !== NULL ) && (count($jsons) > 13) && ($jsons['0'] !== '!'))
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
                $prumada->PRU_STATUS = 0;
                $prumada->save();
                Session::flash('error', 'Unidade não pode ser desligada. Por favor, verifique a conexão.');
            }   

        }

        return redirect('unidade/ver/'.$unidd);
    }


}
