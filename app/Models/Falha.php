<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Falha extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    
    public function prumada()
    {
        return $this->belongsTo(Prumada::class);
    }

}
