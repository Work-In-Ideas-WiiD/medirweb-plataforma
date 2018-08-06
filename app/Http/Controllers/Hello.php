<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Leitura;

class Hello extends Controller
{
    //
    public function index()
    {
    	//
    	return "Hello world";
    }

    public function show($name)
    {
    	return view('hello',array('name' => $name));
    }

    public function cadastro()
    {
    	return view('cadastro/adicionar');	
    }

    public function postAdicionar(Request $request)
    {
    	var_dump(request('titulo'));
    	var_dump(request('conteudo'));
    }

    public function testeLeitura()
    {
        $unidade = Unidade::find(3);

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
}
