<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leitura extends Model
{
    /*const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';*/

    protected $primaryKey = 'LEI_ID';

    protected  $dates = [
        'created_at', 'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s+';

    public function prumada()
    {
    	return $this->hasOne('App\Models\Prumada', 'PRU_ID', 'LEI_IDPRUMADA');

    }

}
