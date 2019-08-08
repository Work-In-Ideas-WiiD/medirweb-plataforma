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
        return $this->hasOne('App\Models\Imovel');
    }

    public function getUnidades()
    {
        return $this->hasMany('App\Models\Unidade');
    }
}
