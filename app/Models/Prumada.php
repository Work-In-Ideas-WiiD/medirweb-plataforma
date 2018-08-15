<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prumada extends Model
{
	const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    protected $dateFormat = 'Y-m-d H:i';

    protected $primaryKey = 'PRU_ID';

    public function unidade()
    {
        return $this->hasOne('App\Models\Unidade', 'UNI_ID', 'PRU_IDUNIDADE');
    }

    public function getLeituras()
    {
    	return $this->hasMany('App\Models\Leitura','LEI_IDPRUMADA', 'PRU_ID');
    }
    
}
