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
                array_push($arrayPrumadas, $prumada);
            }
        }

        return response()->json(response()->make($arrayPrumadas), 200);
    }

}
