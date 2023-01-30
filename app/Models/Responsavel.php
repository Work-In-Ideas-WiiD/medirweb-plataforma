<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsavel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }
}
