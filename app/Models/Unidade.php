<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prumada;
use App\Models\Agrupamento;
use App\Models\Equipamento;
use App\Models\Imovel;

class Unidade extends Model
{
    protected $guarded = [];


    public function agrupamento()
    {
        return $this->hasOne('App\Models\Agrupamento');
    }

    public function imovel()
    {
        return $this->hasOne('App\Models\Imovel');
    }

    public function prumada()
    {
    	return $this->hasMany('App\Models\Prumada');
    }

    public function getPrumadas()
    {
    	return $this->hasMany('App\Models\Prumada');
    }

    public function getEquipamentos()
    {
        return $this->hasMany('App\Models\Equipamento');
    }
}
