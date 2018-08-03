<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    public $timestamps = false;
    // protected $primaryKey = 'id_postagem';

    protected $primaryKey = 'CID_ID';

    public function estado()
    {
        return $this->hasOne('App\Models\Estado', 'foreign_key', 'CID_IDESTADO');
    }
}
