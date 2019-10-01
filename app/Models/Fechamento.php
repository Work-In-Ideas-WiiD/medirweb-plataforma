<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fechamento extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function prumada()
    {
    	return $this->hasOne('App\Models\Prumada');

    }
}
