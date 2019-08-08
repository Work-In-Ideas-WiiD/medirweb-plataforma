<?php

namespace App\Models;
use App\Models\Unidade;
use App\Models\Leitura;

use Illuminate\Database\Eloquent\Model;

class Prumada extends Model
{
    protected $guarded = [];

    protected  $dates = [
        'created_at', 'updated_at'
    ];

    public function unidade()
    {
        return $this->hasOne('App\Models\Unidade');
    }

    public function getLeituras()
    {
    	return $this->hasMany('App\Models\Leitura');
    }

}
