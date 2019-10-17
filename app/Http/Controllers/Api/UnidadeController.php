<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unidade;
use App\Models\Imovel;
use App\User;

class UnidadeController extends Controller
{
    public function imovel(Request $request)
    {
        return Imovel::with('endereco.cidade.estado')->find($request->imovel_id);
    }

    public function agrupamento(Request $request)
    {
        return Unidade::with('agrupamento')->find($request->unidade_id)->agrupamento;
    }

    public function show(Request $request)
    {
        return $request->user()->unidade;
    }
}
