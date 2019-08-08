<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function agrupamento()
    {
        return $this->hasOne(Agrupamento::class);
    }

    public function imovel()
    {
        return $this->hasOne(Imovel::class);
    }

    public function equipamento()
    {
        return $this->hasMany(Equipamento::class);
    }

    public function prumada()
    {
    	return $this->hasMany(Prumada::class);
    }

    public function getPrumadas()
    {
    	return $this->hasMany(Prumada::class);
    }

    public function getEquipamentos()
    {
        return $this->hasMany(Equipamento::class);
    }
}
