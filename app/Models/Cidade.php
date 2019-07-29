<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{

    protected $primaryKey = 'CID_ID';

    public function estado()
    {
        return $this->hasOne('App\Models\Estado', 'EST_ID', 'CID_IDESTADO');
    }
}
