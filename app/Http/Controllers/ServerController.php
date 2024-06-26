<?php

namespace App\Http\Controllers;

use App\Http\Requests\Server\ComandosRequest;
use App\Http\Requests\Server\ProcessLocalTestRequest;
use App\Http\Requests\Server\ProcessTestRequest;
use App\Models\Imovel;
use Ping, Curl;
use App\Models\Prumada;

class ServerController extends Controller
{
    public function test()
    {
        $imoveis = Imovel::pluck('nome', 'id');

        return view('server.test', compact('imoveis'));
    }

    public function processTest(ProcessTestRequest $data)
    {
        $imoveis = Imovel::pluck('nome', 'id');
 
        $imovel = Imovel::whereNotNull('ip')->whereId($data->imovel_id)->first();

        if(!$imovel)
            return back()->withError('Este Imovel não possui endereço de IP configurado!');

            
        $codigoHTTP = Ping::check($imovel->host);
        
        
        return view('server.test', compact('imoveis', 'imovel', 'codigoHTTP'));
    }

    public function localTest()
    {
        $imoveis = Imovel::pluck('nome', 'id');

        return view('server.local_test', compact('imoveis'));
    }

    public function processLocalTest(ProcessLocalTestRequest $data)
    {
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', 0);

        try {
            $imoveis = Imovel::pluck('nome', 'id');
            
            $imovel = Imovel::whereNotNull('ip')->whereId($data->imovel_id)->first();

            if(!$imovel)
                return back()->withError('Este Imovel não possui endereço de IP configurado!');

            $testes = [];

            $funcionais = [];

            if (!empty($data->repetidor_id))
                Curl::to("http://{$imovel->host}/api/ativacao/".dechex($data->repetidor_id))->get();

            foreach (explode(';', $data->funcional_id) as $info) {
                if (strstr($info, '-')) {
                    $info = explode('-', $info);
                    for ($i = $info[0]; $i <= $info[1]; $i++) {
                        $funcionais[] = dechex(intval($i));
                    }

                } else {
                    $funcionais[] = dechex(intval($info));
                }

            }

            foreach ($funcionais as $funcional) {
                $response = Curl::to("{$imovel->host}/api/leitura/{$funcional}")->get();

                $teste = converter_leitura(hexdec($funcional), $response, $response);

                if (empty($teste->erro))
                    $testes[] = $teste;
                else
                    $testes[] = converter_leitura_default($funcional);
            }

            $codigoHTTP = Ping::check($imovel->host);

            if (!empty($data->repetidor_id))
                Curl::to("http://{$imovel->host}/api/corte/".dechex($data->repetidor_id))->get();

            return view('server.local_test', compact('imoveis', 'imovel', 'testes', 'codigoHTTP'));

        } catch (Exception $e) {

            if (!empty($data->repetidor_id))
                Curl::to("http://{$imovel->host}/api/corte/".dechex($data->repetidor_id))->get();

            return back()->withError('Ocorreu um erro inesperado!');
        }
    }

    public function comandos()
    {
        $imoveis = Imovel::pluck('nome', 'id');

        $comandos = [
            '06_00_20_00_00' => 'ligar',
            '06_00_20_FF_00' => 'desligar',
            '03_00_17_00_01' => 'leitura pulso',
            '06_00_17_00_96' => 'set pulso'
        ];

        return view('server.comandos', compact('imoveis', 'comandos'));
    }

    public function comandosPost(ComandosRequest $request)
    {
        $imovel = Imovel::whereNotNull('ip')->whereId($request->imovel_id)->first();

        if ($request->comando == '06_00_17_00_96')
            $request->comando = str_replace('96', dechex($request->pulsos), $request->comando);

        
        $response = Curl::to("http://{$imovel->host}/comando/".dechex($request->repetidor_id).'/'.$request->comando)->get();

        if (empty($response))
            $response = ['status' => 'error', 'message' => 'ocorreu um erro desconhecido, tente novamente!'];

        return back()->with('response', json_encode($response));
    }
}
