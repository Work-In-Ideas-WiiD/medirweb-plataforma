<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class Imovel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function agrupamento()
    {
        return $this->hasMany(Agrupamento::class);
    }

    public function unidade(){
        return $this->hasMany(Unidade::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function users()
    {
    	return $this->hasMany(User::class);
    }

}
