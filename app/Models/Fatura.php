<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $guarded = [];

    public function unidade()
    {
        return $this->hasMany(FaturaUnidade::class);
    }
}
