<?php

namespace App\Http\Controllers;

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

        $codigoHTTP = Ping::check($imovel->ip);

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

        $imoveis = Imovel::pluck('nome', 'id');
        
        $imovel = Imovel::whereNotNull('ip')->whereId($data->imovel_id)->first();

        if(!$imovel)
            return back()->withError('Este Imovel não possui endereço de IP configurado!');

        $testes = [];

        $funcionais = [];
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
            $response = Curl::to("{$imovel->ip}/api/leitura/{$funcional}")->get();
            $testes[] = $this->converter($funcional, $response, $response);
        }
        
        $codigoHTTP = Ping::check($imovel->ip);

        return view('server.local_test', compact('imoveis', 'imovel', 'testes', 'codigoHTTP'));
    }


    private function converter($funcional, $hex, $hex_original)
    {
        if ($hex) {
            $hex = json_decode($hex);

            if (count($hex) > 15)
                return $this->novo($funcional, $hex, $hex_original);
            
            return $this->antigo($funcional, $hex, $hex_original);
        }

        return (object) [
            'funcional' => $funcional,
            'hexadecimal' => 'nenhuma informação',
            'm3' => 'N/A',
            'litros' => 'N/A',
            'decilitros' => 'N/A'
        ];
    }

    private function antigo($funcional, $hex, $hex_original)
    {
        return (object) [
            'funcional' => $funcional,
            'hexadecimal' => $hex_original,
            'm3' => hexdec($hex['5'].$hex['6']),
            'litros' => hexdec($hex['9'].$hex['10']),
            'decilitros' => hexdec($hex['13'].$hex['14'])
        ];
    }

    private function novo($funcional, $hex, $hex_original)
    {
        return (object) [
            'funcional' => $funcional,
            'hexadecimal' => $hex_original,
            'm3' => hexdec($hex['5'].$hex['6'].$hex['7']),
            'litros' => hexdec($hex['10'].$hex['11']),
            'decilitros' => hexdec($jsons['15'])
        ];
    }
}
