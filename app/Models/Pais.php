<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pais extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function estado()
    {
        return $this->hasMany(Estado::class);
    }
}
