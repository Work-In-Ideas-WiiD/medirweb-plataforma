<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unidade;
use App\User;

class UnidadeController extends Controller
{

    public function showImovel(Request $request)
    {
        $imovel = Unidade::with('endereco.cidade.estado')->find($request->UNI_ID)->imovel;

        $imovel['IMO_IDCIDADE'] = $imovel->endereco->cidade->nome;
        $imovel['IMO_IDESTADO'] = $imovel->endereco->cidade->estado->codigo;

        return response()->json(response()->make($imovel), 200);
    }

    public function showAgrupamento(Request $request)
    {
        $agrupamento = Unidade::find($request->UNI_ID)->agrupamento;

        return response()->json(response()->make($agrupamento), 200);
    }

    public function showUnidade(Request $request)
    {
        //$unidade = Unidade::where('UNI_IDUSER', $request->UNI_IDUSER)->first();

        $user = User::find($request->UNI_IDUSER);
        $unidade = $user->unidade;

        return response()->json(response()->make($unidade), 200);
    }

    /*public function showPrumadas(Request $request)
    {
        $prumadas = Unidade::find($request->UNI_ID)->getPrumadas;

        return response()->json(response()->make($prumadas), 200);
    }*/

}
