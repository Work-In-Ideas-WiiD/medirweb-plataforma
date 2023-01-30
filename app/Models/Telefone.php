<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telefone extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
