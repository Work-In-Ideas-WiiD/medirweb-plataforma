<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteTelefone extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
