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
        return $request->user()->imovel()->with('endereco.cidade.estado', 'telefone')->first();
    }

    public function agrupamento(Request $request)
    {
        return $request->user()->unidade->agrupamento;
    }

    public function show(Request $request)
    {
        return $request->user()->unidade()->with('telefone')->first();
    }

    public function consumoUltimosMeses(Request $request)
    {
        foreach (range(1, $request->meses ?? 3) as $mes) {
            $data = now()->subMonth($mes);

            $consumo[$data->month] = somar_consumo([
                'mes' => $data->month,
                'ano' => $data->year,
                'unidade' => auth()->user()->unidade_id,
            ]);

            
        }

        return $consumo;

    }
}
