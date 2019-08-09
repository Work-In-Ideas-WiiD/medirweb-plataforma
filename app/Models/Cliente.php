<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function contaBancaria()
    {
        return $this->hasMany(ContaBancaria::class);
    }

    public function cidade()
    {
        return $this->hasOne(Cidade::class);
    }

    public function getImoveis(){
        return $this->hasMany(Imovel::class);
    }

    public function telefone()
    {
        return $this->hasMany(ClienteTelefone::class);
    }

}
