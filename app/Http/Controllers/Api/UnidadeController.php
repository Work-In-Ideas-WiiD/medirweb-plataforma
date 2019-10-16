<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unidade;
use App\Models\Imovel;
use App\User;

class UnidadeController extends Controller
{

    public function showImovel(Request $request)
    {
        return Imovel::with('endereco.cidade.estado')->find($request->imovel_id);
    }

    public function showAgrupamento(Request $request)
    {
        return Unidade::with('agrupamento')->find($request->unidade_id)->agrupamento;
    }

    public function show(Request $request)
    {
        return $user->unidade;
    }
}
