<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cidade extends Model
{
    use SoftDeletes;

    public function estado()
    {
        return $this->hasOne('App\Models\Estado');
    }
}
