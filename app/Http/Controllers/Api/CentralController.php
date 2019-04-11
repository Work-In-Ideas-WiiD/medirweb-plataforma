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

class CentralController extends Controller
{

    public function getPrumadas($ip)
    {

        $imovel = Imovel::where('IMO_IP', $ip)->first();
        $unidades = $imovel->getUnidades;
        $arrayPrumadas = array();

        foreach ($unidades as $unidade) {
            $prumadas = $unidade->getPrumadas;

            foreach ($prumadas as $prumada) {

                $dados['EQP_IDUNI'] = $unidade->UNI_ID;
                $dados['EQP_IDPRU'] = $prumada->PRU_ID;
                $dados['EQP_IDFUNCIONAL'] = $prumada->PRU_IDFUNCIONAL;

                array_push($arrayPrumadas, $dados);
            }
        }

        return response()->json(response()->make($arrayPrumadas), 200);
    }

}
