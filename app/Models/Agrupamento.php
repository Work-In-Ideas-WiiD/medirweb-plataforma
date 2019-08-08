<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agrupamento extends Model
{
    protected $guarded = [];

    public function imovel()
    {
        return $this->hasOne('App\Models\Imovel');
    }

    public function getUnidades()
    {
        return $this->hasMany('App\Models\Unidade');
    }
}
