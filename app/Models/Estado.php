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
        return $this->hasMany(Cidade::class);
    }
}
