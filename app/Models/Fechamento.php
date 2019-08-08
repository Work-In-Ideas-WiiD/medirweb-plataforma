<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fechamento extends Model
{
    protected $guarded = [];

    protected  $dates = [
        'created_at', 'updated_at'
    ];

    public function prumada()
    {
    	return $this->hasOne('App\Models\Prumada');

    }
}
