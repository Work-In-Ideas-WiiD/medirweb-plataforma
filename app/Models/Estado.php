<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function getCidades()
    {
    	return $this->hasMany('App\Models\Cidade');
    }
}
