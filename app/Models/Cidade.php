<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{

    public function estado()
    {
        return $this->hasOne('App\Models\Estado');
    }
}
