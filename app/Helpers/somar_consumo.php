<?php

use App\Models\Leitura;

function somar_consumo($array) {
    return Leitura::whereHas('prumada.unidade', function($query) use ($array) {
        
        $query->where('imovel_id', $array['imovel_id'] ?? auth()->user()->imovel_id);

        $query->when($array['bloco'] ?? null, function($subquery, $bloco) {
            $subquery->whereHas('agrupamento', function($subsubquery) use ($bloco) {
                $subsubquery->where('nome', $bloco);
            });
        });
        $query->when($array['unidade'] ?? null, function($subquery, $unidade) {
            $subquery->where('nome', $unidade);
        });
    })->when($array['ano'] ?? null, function($query, $ano) {
        $query->whereYear('created_at', $ano);
    })->when($array['mes'] ?? null, function($query, $mes) {
        $query->whereMonth('created_at', $mes);
    })->when($array['dia'] ?? null, function($query, $dia) {
        $query->whereDay('created_at', $dia);
    })->sum('consumo');
}