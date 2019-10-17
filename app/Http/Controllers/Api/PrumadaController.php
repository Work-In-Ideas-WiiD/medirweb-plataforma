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
use Curl;

class PrumadaController extends Controller
{

    public function leitura(Request $request)
    {
        $prumada = Prumada::has('unidade.imovel')->with('unidade:id,imovel_id', 'unidade.imovel:id,ip,porta')->find($request->prumada_id);

        if ($prumada) {
            $response = Curl::to("{$prumada->unidade->imovel->host}/api/leitura/".dechex($prumada->funcional_id))->get();

            $leitura = converter_leitura(hexdec($prumada->funcional_id), $response, $response);

            if(empty($leitura->erro) and $leitura) {

                return Leitura::create([
                    'prumada_id' => $prumada->id,
                    'metro' => $leitura->m3,
                    'litro' => $leitura->litros,
                    'mililitro' => $leitura->decilitros,
                    'valor' => $leitura->valor,
                ]);

            } else {
                $prumada->update(['status' => 0]);

                return ['error' => 'Leitura não pode ser realizada. Por favor, verifique a conexão'];
            }
        }

        return ['error' => 'Prumada não encontrada!'];
    }

    public function ligar(Request $request)
    {
        $prumada = Prumada::has('unidade.imovel')->with('unidade:id,imovel_id', 'unidade.imovel:id,ip,porta')->find($request->prumada_id);

        if ($prumada) {
            $response = Curl::to("{$prumada->unidade->imovel->host}/api/ativacao/".dechex($prumada->funcional_id))->get();
            
            $response = json_decode($response);

            if($response) {
                if($jsons[4] == '00')
                    $prumada->status = 1;
                else
                    $prumada->status = 0;

                $prumada->save();

                return ['success' => 'Equipamento ligado com sucesso.'];
            } else {
                $prumada->update(['status' => 0]);

                return ['error' => 'Não foi possível ligar o equipamento. Por favor, verifique a conexão.'];
            }
        }

        return ['error' => 'Prumada não encontrada!'];
    }

    public function desligarPrumada(Request $request)
    {
        $prumada = Prumada::find($request->PRU_ID);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$prumada->unidade->imovel->ip.'/api/corte/'.dechex($prumada->funcional_id),
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
                'status' => $status,
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

    }

    /*public function ultimaLeitura(Request $request)
    {
        $ultimaleitura =  Leitura::where('LEI_IDPRUMADA',$request->PRU_ID)
        ->orderBy('LEI_ID', 'desc')
        ->first();

        return response()->json(response()->make($ultimaleitura), 200);
    }*/

}
