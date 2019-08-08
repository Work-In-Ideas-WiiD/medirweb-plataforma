<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prumada extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function unidade()
    {
        return $this->hasOne(Unidade::class);
    }

    public function leitura()
    {
        return $this->hasMany(Leitura::class);
    }

    public function getLeituras()
    {
    	return $this->hasMany('App\Models\Leitura');
    }

}
