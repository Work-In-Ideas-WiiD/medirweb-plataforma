<?php

namespace App\Http\Controllers;

use App\Models\UnidadeAlerta;
use Illuminate\Http\Request;

class UnidadeAlertaController extends Controller
{
    public function marcarComoVisto($alerta)
    {
        $alerta = UnidadeAlerta::where('id', $alerta)->whereHas('unidade', function($query) {
            $query->where('imovel_id', auth()->user()->imovel_id);
        })->first();

        if ($alerta) {
            $alerta->update(['visto_em' => now()]);

            return ['success' => true];
        }

    }
}
