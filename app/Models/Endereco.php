<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function imovel()
    {
        return $this->hasOne(Imovel::class);
    }
}
