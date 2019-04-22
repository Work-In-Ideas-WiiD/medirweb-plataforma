<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Leitura;
use App\Teste;
use Session;
use App\Models\Imovel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeituraExport;

class Hello extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

    	//
    	return "Hello world";
    }

    public function show($name)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

    	return view('hello',array('name' => $name));
    }

    public function cadastro()
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

    	return view('cadastro/adicionar');
    }

    public function postAdicionar(Request $request)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

    	var_dump(request('titulo'));
    	var_dump(request('conteudo'));
    }

    public function testeLeitura($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://192.168.130.4/api/leitura/'.dechex($id),
            //CURLOPT_URL => 'http://192.168.255.18/api/leitura/03',
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        $jsons = json_decode($resp);

        var_dump($resp); die();

        $unidade = Unidade::find(3);

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

            $metro_cubico = hexdec(''.$jsons['5'].''.$jsons['6'].'');

            $litros = hexdec(''.$jsons['9'].''.$jsons['10'].'');

            $mililitro = hexdec(''.$jsons['13'].''.$jsons['14'].'');
//
//                var_dump($metro_cubico);
//                var_dump($litros);
//                var_dump($mililitro);

            $subtotal = ($metro_cubico * 1000) + $litros;
            $total = $subtotal.'.'.$mililitro.'';


            //var_dump($total); die();

            $leitura = [
                'LEI_IDPRUMADA' => $prumada->PRU_ID,
                'LEI_METRO' => $metro_cubico,
                'LEI_LITRO' => $litros,
                'LEI_MILILITRO' => $mililitro,
                'LEI_VALOR' => $total,
            ];

            Leitura::create($leitura);

            echo 'leitura cadastrada';

        }
    }

    public function hidrometroTeste($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $unidades = Teste::where('id_imovel', $id)->get();
        $imovel = Imovel::find($id);

        return view('teste.index', compact('unidades', 'imovel'));
    }

    public function leituraTeste($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $teste = Teste::find($id);

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$teste->ip_equipamento.'/api/leitura/'.$teste->id_hidrometro,
            //CURLOPT_URL => 'http://192.168.255.18/api/leitura/03',
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
                'metro' => $metro_cubico,
                'litro' => $litros,
                'mililitro' => $mililitro,
                'valor' => $total,
            ];

            $teste->update($leitura);
        }
        else
        {
            $teste->status = 0;
            $teste->save();
            Session::flash('error', 'Leitura não pode ser realizada. Por favor, verifique a conexão.' );
        }

        return redirect('teste/'.$teste->id_imovel);
    }

    public function ligarTeste($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $teste = Teste::find($id);

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$teste->ip_equipamento.'/api/ativacao/'.$teste->id_hidrometro,
            //CURLOPT_URL => 'http://192.168.255.18/api/ativacao/03',
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
                'status' => $status,
            ];

            $teste->update($atualizacao);
        }
        else
        {
            $teste->status = 0;
            $teste->save();
            Session::flash('error', 'Ação não pode ser realizada. Por favor, verifique a conexão.' );
        }

        return redirect('teste/'.$teste->id_imovel);
    }

    public function desligarTeste($id)
    {
        if(!app('defender')->hasRoles('Administrador')){
            return view('error403');
        }

        $teste = Teste::find($id);

        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$teste->ip_equipamento.'/api/corte/'.$teste->id_hidrometro,
            //CURLOPT_URL => 'http://192.168.255.18/api/corte/03',
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
                'status' => $status,
            ];

            $teste->update($atualizacao);
        }
        else
        {
            $teste->status = 1;
            $teste->save();
            Session::flash('error', 'Ação não pode ser realizada. Por favor, verifique a conexão.' );
        }

        return redirect('teste/'.$teste->id_imovel);

    }
}
