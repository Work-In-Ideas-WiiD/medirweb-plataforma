<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function getCidades()
    {
    	return $this->hasMany('App\Models\Cidade');
    }
}
