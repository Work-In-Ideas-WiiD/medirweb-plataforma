<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unidade;

class UnidadeController extends Controller
{

    public function showImovel(Request $request)
    {
        $imovel = Unidade::find($request->UNI_ID)->imovel;

        $imovel['IMO_IDCIDADE'] = Unidade::find($request->UNI_ID)->imovel->cidade->CID_NOME;
        $imovel['IMO_IDESTADO'] = Unidade::find($request->UNI_ID)->imovel->estado->EST_ABREVIACAO;

        return response()->json(response()->make($imovel), 200);
    }

    public function showAgrupamento(Request $request)
    {
        $agrupamento = Unidade::find($request->UNI_ID)->agrupamento;

        return response()->json(response()->make($agrupamento), 200);
    }

    public function showUnidade(Request $request)
    {
        $unidade = Unidade::where('UNI_IDUSER', $request->UNI_IDUSER)->first();

        return response()->json(response()->make($unidade), 200);
    }

    /*public function showPrumadas(Request $request)
    {
        $prumadas = Unidade::find($request->UNI_ID)->getPrumadas;

        return response()->json(response()->make($prumadas), 200);
    }*/

}
