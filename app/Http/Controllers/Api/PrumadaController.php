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

    public function ligarDesligar(Request $request, $comando = '')
    {
        $prumada = Prumada::has('unidade.imovel')->with('unidade:id,imovel_id', 'unidade.imovel:id,ip,porta')->find($request->prumada_id);

        if ($prumada) {
            $response = Curl::to("{$prumada->unidade->imovel->host}/api/{$comando}/".dechex($prumada->funcional_id))->get();
            
            $response = json_decode($response);

            return $this->_ligarDesligar($prumada, $response, $comando);

        }

        return ['error' => 'Prumada não encontrada!'];
    }


    private function _ligarDesligar($prumada, $response, $comando)
    {
        if($response) {
            if (prumada_status($response) == '00')
                $prumada->status = 1;
            else
                $prumada->status = 0;

            $prumada->save();

            $string = $comando == 'ativacao' ? 'ligado' : 'desligado';

            return ['success' => "Equipamento {$string} com sucesso."];

        } else {
            $prumada->update(['status' => 0]);
            $string = $comando == 'ativacao' ? 'ligar' : 'desligar';

            return ['error' => "Não foi possível {$string} o equipamento. Por favor, verifique a conexão."];
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
