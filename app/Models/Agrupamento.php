<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agrupamento extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function imovel()
    {
        return $this->hasOne(Imovel::class);
    }

    public function unidade()
    {
        return $this->hasMany(Unidade::class);
    }
}
