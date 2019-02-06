<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Leitura;
use App\Models\Agrupamento;
use App\Models\Imovel;
use App\Models\Prumada;
use App\Http\Requests\Unidade\UnidadeSaveRequest;

class UnidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $imoveis = ['' => 'Selecionar Imovel'];
        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel)
        $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;

        return view('unidade.cadastrar', ['imoveis' => $imoveis]);
    }

    public function showAgrupamento($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        //$agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->pluck('AGR_NOME','AGR_ID')->toArray();

        $agrupamentos = Agrupamento::where('AGR_IDIMOVEL', $id)->get();

        if(is_null($agrupamentos)){
            return redirect( URL::previous() );
        }


        return json_encode($agrupamentos);
    }

    public function store(UnidadeSaveRequest $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $dataForm = $request->all();

        $undiade = Unidade::create($dataForm);

        return redirect('/imovel')->with('success', 'Unidade cadastrada com sucesso.');
    }

    public function edit($id)
    {
        $user = auth()->user()->USER_IMOID;
		$ID_IMO = Unidade::find($id)->agrupamento->imovel->IMO_ID;
        if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        $unidade  = Unidade::findOrFail($id);

        if(is_null($unidade)){
            return redirect( URL::previous() );
        }

        $_imoveis = Imovel::all();
        foreach($_imoveis as $imovel){
            $imoveis[$imovel->IMO_ID] = $imovel->IMO_NOME;
        }

        $_agrupamentos = Agrupamento::all();
        foreach($_agrupamentos as $agrupamento){
            $agrupamentos[$agrupamento->AGR_ID] = $agrupamento->AGR_NOME;
        }

        $prumadas = Prumada::where('PRU_IDUNIDADE', $unidade->UNI_ID)->get();

        //$prumadas = $unidade->getPrumadas();

        return view('unidade.editar', compact('unidade', 'imoveis', 'agrupamentos', 'prumadas'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user()->USER_IMOID;
		$ID_IMO = Unidade::find($id)->agrupamento->imovel->IMO_ID;
        if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        $unidade = Unidade::findOrFail($id);

        if(is_null($unidade)){
            return redirect( URL::previous() );
        }

        $dataForm = $request->all();

        $unidade->update($dataForm);

        return redirect('/unidade/editar/'.$id)->with('success', 'Unidade atualizado com sucesso.');
    }

    public function destroy(Request $request, $id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        Unidade::destroy($id);

        return redirect('/imovel')->with('success', 'Unidade deletado com sucesso.');
    }

    /*public function leituraUnidade($undd)
    {
        $user = auth()->user()->USER_IMOID;
		$ID_IMO = Unidade::find($undd)->imovel->IMO_ID;

        var_dump($ID_IMO);
        die;
        if(app('defender')->hasRoles('Sindico') && !($user == $ID_IMO)){
            return view('error403');
        }
        if(!app('defender')->hasRoles(['Administrador', 'Sindico'])){
            return view('error403');
        }

        $unidade = Unidade::find($undd);

        //var_dump($unidade->getPrumadas); die();
        foreach ($unidade->getPrumadas as $prumada)
        {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://192.168.130.4/api/leitura/'.$prumada->PRU_ID,
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
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $unidade = Unidade::find($undd);

        //var_dump($unidade->getPrumadas); die();
        foreach ($unidade->getPrumadas as $prumada)
        {
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'http://192.168.130.4/api/ativacao/'.$prumada->PRU_ID,
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
                CURLOPT_URL => 'http://192.168.130.4/api/corte/'.$prumada->PRU_ID,
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
    }*/

}
