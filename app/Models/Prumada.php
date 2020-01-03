<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Prumada extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function criarTimeline($acao, $antigo, $novo, $icone)
	{
        $this->timeline()->create([
			"user" => auth()->user()->name,
			"descricao" => "atualizou o '{$acao}' do equipamento #{$this->id} de '<a>{$antigo}</a>' para '<a>{$novo}</a>'",
			"icone" => "fa fa-{$icone}"
		]);
	}

    public function getRepetidorAttribute()
    {
        if (!empty($this->repetidor_id))
            $repetidor = "/".dechex($this->repetidor_id);

        return $repetidor ?? '';
    }
    
    public function leitura()
    {
        return $this->hasMany(Leitura::class);
    }

    public function timeline()
    {
        return $this->hasMany(Timeline::class);
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
