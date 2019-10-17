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
        return $request->user()->imovel()->with('endereco', 'telefone')->first();
    }

    public function agrupamento(Request $request)
    {
        return $request->user()->unidade->agrupamento;
    }

    public function show(Request $request)
    {
        return $request->user()->unidade;
    }
}
