<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadeAlerta extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
