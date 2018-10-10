<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teste extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'metro', 'litro', 'mililitro', 'diferenca', 'valor', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected  $dates = [
        'created_at', 'updated_at'
    ];
}
