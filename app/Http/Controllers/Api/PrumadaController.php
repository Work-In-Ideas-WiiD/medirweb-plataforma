<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Prumada;
use App\Models\Leitura;
use Session;

class PrumadaController extends Controller
{

    public function leituraPrumada(Request $request)
    {
        $prumada = Prumada::find($request->PRU_ID);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$prumada->unidade->imovel->IMO_IP.'/api/leitura/'.dechex($prumada->PRU_IDFUNCIONAL),
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
        ));

        $resp = curl_exec($curl);

        curl_close($curl);

        $jsons = json_decode($resp);

        if(($jsons !== NULL ) && (count($jsons) > 13) && ($jsons['0'] !== '!'))
        {
            $metro_cubico = hexdec(''.$jsons['5'].''.$jsons['6'].'');

            $litros = hexdec(''.$jsons['9'].''.$jsons['10'].'');

            $mililitro = hexdec(''.$jsons['13'].''.$jsons['14'].'');

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
            //return response()->json(['success' => 'Leitura realizada com sucesso.'], 200);

            return response()->json(response()->make($leitura), 200);
        }
        else
        {
            $prumada->PRU_STATUS = 0;
            $prumada->save();
            return response()->json(['error' => 'Leitura não pode ser realizada. Por favor, verifique a conexão'], 400);
        }

    }

    /*public function ligarPrumada(Request $request)
    {
        $prumada = Prumada::find($request->PRU_ID);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$prumada->unidade->imovel->IMO_IP.'/api/ativacao/'.dechex($prumada->PRU_IDFUNCIONAL),
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));

        $resp = curl_exec($curl);

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
            return response()->json(['success' => 'Equipamento ligado com sucesso.'], 200);
        }
        else
        {
            $prumada->PRU_STATUS = 0;
            $prumada->save();
            return response()->json(['error' => 'Não foi possível ligar o equipamento. Por favor, verifique a conexão.'], 400);
        }

    }*/

    /*public function desligarPrumada(Request $request)
    {
        $prumada = Prumada::find($request->PRU_ID);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$prumada->unidade->imovel->IMO_IP.'/api/corte/'.dechex($prumada->PRU_IDFUNCIONAL),
            CURLOPT_CONNECTTIMEOUT => 15,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));

        $resp = curl_exec($curl);

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
            return response()->json(['success' => 'Equipamento desligado com sucesso.'], 200);
        }
        else
        {
            $prumada->PRU_STATUS = 1;
            $prumada->save();
            return response()->json(['error' => 'Não foi possível desligar o equipamento. Por favor, verifique a conexão.'], 400);
        }

    }*/

    /*public function ultimaLeitura(Request $request)
    {
        $ultimaleitura =  Leitura::where('LEI_IDPRUMADA',$request->PRU_ID)
        ->orderBy('LEI_ID', 'desc')
        ->first();

        return response()->json(response()->make($ultimaleitura), 200);
    }*/

}
