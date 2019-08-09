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
        return $this->hasMany(ClienteContaBancaria::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function imovel()
    {
        return $this->hasMany(Imovel::class);
    }

    public function telefone()
    {
        return $this->hasMany(ClienteTelefone::class);
    }

}
