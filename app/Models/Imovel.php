<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Agrupamento;
use App\Models\Unidade;
use App\User;

class Imovel extends Model
{
    protected $guarded = [];


    protected  $dates = [
        'created_at', 'updated_at'
    ];

    public function estado()
    {
        return $this->hasOne('App\Models\Estado');
    }

    public function cidade()
    {
        return $this->hasOne('App\Models\Cidade');
    }

    public function agrupamento()
    {
        return $this->hasMany('App\Models\Agrupamento');
    }

    public function getAgrupamentos(){
        return $this->hasMany('App\Models\Agrupamento');
    }

    public function unidade(){
        return $this->hasMany('App\Models\Unidade');
    }

    public function getUnidades(){
        return $this->hasMany('App\Models\Unidade');
    }

    public function administrador()
    {
        return $this->hasOne('App\Models\Cliente');
    }

    public function users()
    {
    	return $this->hasMany('App\User');
    }

}
