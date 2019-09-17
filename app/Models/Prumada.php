<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prumada extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function leitura()
    {
        return $this->hasMany(Leitura::class);
    }
    
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function fatura()
    {
        return $this->hasMany(PrumadaFatura::class);
    }

    public function scopeByImovel($query, $value)
    {
        return $query->join('unidades', 'unidades.id', '=', 'prumadas.unidade_id')
            ->join('imoveis', 'imoveis.id', '=', 'unidades.imovel_id')
            ->where('imoveis.id', $value)->get();
    }
}
