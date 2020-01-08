<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB, Carbon\Carbon;


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


    public function leituraAt($data, $hora)
    {
        /*echo '<pre>';
        print_r($data, $hora);
*/
        #a data sempre vem como 00:00 horas
        $data_inicial = Carbon::parse($data->format('Y-m-d'))->addHours($hora);

        $data_final = Carbon::parse($data->format('Y-m-d'))
            ->addHours($hora)->addMinutes(59)->addSeconds(59);

        return $this->hasMany(Leitura::class)->whereBetween('created_at', [
            $data_inicial,
            $data_final,
        ]);

    }

    public function leitura_ciclica($data, $horas = [], $colunas = ['metro'])
    {
        $leituras = [];

        foreach ($horas as $hora) {
            $leituras[$hora] = $this->leituraAt($data, $hora)->select($colunas)->first();
        }

        return $leituras;
    }

}
