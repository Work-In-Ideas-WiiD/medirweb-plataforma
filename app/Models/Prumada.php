<?php

namespace App\Models;
use App\Models\Unidade;
use App\Models\Leitura;

use Illuminate\Database\Eloquent\Model;

class Prumada extends Model
{
    protected $fillable = [
        'PRU_ID', 'PRU_IDUNIDADE', 'PRU_NOME', 'PRU_IDFUNCIONAL', 'PRU_SERIAL', 'PRU_FABRICANTE', 'PRU_MODELO', 'PRU_OPERADORA', 'PRU_STATUS'
    ];

    protected  $dates = [
        'created_at', 'updated_at'
    ];

	const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    //protected $dateFormat = 'Y-m-d H:i';

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
