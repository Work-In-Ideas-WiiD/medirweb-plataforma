<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public $timestamps = false;
    // protected $primaryKey = 'id_postagem';

    protected $primaryKey = 'EST_ID';

    public function getCidades()
    {
    	return $this->hasMany('App\Models\Cidade');
    }
}
