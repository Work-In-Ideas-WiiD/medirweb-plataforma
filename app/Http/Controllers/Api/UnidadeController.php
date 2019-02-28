<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unidade;

class UnidadeController extends Controller
{

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
        $unidade = Unidade::where("UNI_IDUSER", $id)->get();

        return response()->json(response()->make($unidade), 200);
    }

    public function showPrumadas($id)
    {
        $prumadas = Unidade::find($id)->getPrumadas;

        return response()->json(response()->make($prumadas), 200);
    }

}
