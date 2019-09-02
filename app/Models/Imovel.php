<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use DB;


class Imovel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'imoveis';

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function agrupamento()
    {
        return $this->hasMany(Agrupamento::class);
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function unidade(){
        return $this->hasMany(Unidade::class);
    }

    public function responsavel()
    {
        return $this->hasMany(Responsavel::class);
    }

    public function user()
    {
    	return $this->hasMany(User::class);
    }

    public function telefone()
    {
        return $this->hasMany(Telefone::class);
    }

    public function scopeByCidade($query, $value)
    {
        return $query->select('imoveis.*')
            ->join('enderecos', 'enderecos.id', '=', 'imoveis.endereco_id')
            ->where('enderecos.cidade_id', '=', $value)
            ->get();
    }

}
