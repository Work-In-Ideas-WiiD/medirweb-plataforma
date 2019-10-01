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

    public function show(Request $request)
    {
        return $user->unidade;
    }
}
