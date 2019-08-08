<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class Imovel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function estado()
    {
        return $this->hasOne(Estado::class);
    }

    public function cidade()
    {
        return $this->hasOne(Cidade::class);
    }

    public function agrupamento()
    {
        return $this->hasMany(Agrupamento::class);
    }

    public function getAgrupamentos(){
        return $this->hasMany(Agrupamento::class);
    }

    public function unidade(){
        return $this->hasMany(Unidade::class);
    }

    public function getUnidades(){
        return $this->hasMany(Unidade::class);
    }

    public function administrador()
    {
        return $this->hasOne(Cliente::class);
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }

}
