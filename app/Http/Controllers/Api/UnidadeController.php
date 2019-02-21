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

class UnidadeController extends Controller
{

    public function leituraPrumada($prumada)
    {
        $prumada = Prumada::find($prumada);

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
            return response()->json(['success' => 'Leitura realizada com sucesso.'], 200);
        }
        else
        {
            $prumada->PRU_STATUS = 0;
            $prumada->save();
            return response()->json(['error' => 'Leitura não pode ser realizada. Por favor, verifique a conexão'], 400);
        }

    }

    public function showImovel($id)
    {
        $imovel = Unidade::find($id)->imovel;

        return response()->json(response()->make($imovel), 200);
    }

    public function showAgrupamento($id)
    {
        $agrupamento = Unidade::find($id)->agrupamento;

        return response()->json(response()->make($agrupamento), 200);
    }

    public function showUnidade($id)
    {
        $unidade = Unidade::findorFail($id);

        return response()->json(response()->make($unidade), 200);
    }

    public function showPrumadas($id)
    {
        $prumadas = Unidade::find($id)->getPrumadas;

        return response()->json(response()->make($prumadas), 200);
    }

}
