<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Imovel;
use App\Models\Unidade;
use App\Models\Prumada;
use App\Models\Leitura;
USE App\Models\Fechamento;
use Session, Curl;

class CentralController extends Controller
{

    public function getPrumadas($ip)
    {
        $imovel = Imovel::with('unidade.prumada', 'unidade.agrupamento')->where('ip', $ip)->first();
        
        $arrayPrumadas = array();

        if ($imovel) {
            foreach ($imovel->unidade as $unidade) {
        
                foreach ($unidade->prumada as $prumada) {

                    $dados['EQP_IDUNI'] = $unidade->id;
                    $dados['EQP_IDPRU'] = $prumada->id;
                    $dados['EQP_IDFUNCIONAL'] = $prumada->funcional_id;
                    $dados['EQP_BLOCO'] = $unidade->agrupamento->nome;
                    $dados['EQP_IDREPETIDOR'] = $unidade->agrupamento->repetidor_id;

                    array_push($arrayPrumadas, $dados);
                }
            }
        }

        return response()->json(response()->make($arrayPrumadas), 200);
    }

    public function sicronizarLeituras($ip)
    {
        $imovel = Imovel::where('ip', $ip)->first();
        
        $response = Curl::to('http://'.$imovel->host.'/leituras/')
        // $response = Curl::to('http://e80b8f2a.ngrok.io/leituras/')
        ->get();

        $retornos = json_decode($response, TRUE);

        foreach($retornos as $resp)
        {
            Leitura::firstOrCreate([
                "prumada_id" => $resp['LEI_IDPRUMADA'],
                "metro" => $resp['LEI_METRO'],
                "litro" => $resp['LEI_LITRO'],
                "mililitro" => $resp['LEI_MILILITRO'],
                "valor" => $resp['LEI_VALOR'],
                "created_at" => date('Y-m-d H:i:s', strtotime($resp['created_at']) ),
                "updated_at" => date('Y-m-d H:i:s', strtotime($resp['updated_at']) ),
            ]);

        }

        return ['success' => "Scronização Realizada"];

    }


    public function addLeituras(Request $request)
    {
        $dataForm = [
            "FEC_IDPRUMADA" => $request->LEI_IDPRUMADA,
            "FEC_METRO" => $request->LEI_METRO,
            "FEC_LITRO" => $request->LEI_LITRO,
            "FEC_MILILITRO" => $request->LEI_MILILITRO,
            "FEC_VALOR" => $request->LEI_VALOR
        ];
        // var_dump($dataForm);
        // echo $request->FEC_IDPRUMADA;
        $fechamento = Fechamento::where('FEC_IDPRUMADA', $dataForm['FEC_IDPRUMADA'])->first();

        if($fechamento != null) {
            $dataDB = explode('-',$fechamento->created_at);
            $mesAtual = date('m');
            $anoAtual = date('Y');
            if($dataDB[0] != $anoAtual && $dataDB[1] != $mesAtual) {
                Fechamento::create($dataForm);
            }
        }else {
            Fechamento::create($dataForm);
        }
        // Validação de mes
        // Leitura::create($dataForm);

        return response()->json($dataForm, 200);
    }

}
