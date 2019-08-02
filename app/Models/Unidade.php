<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prumada;
use App\Models\Agrupamento;
use App\Models\Equipamento;
use App\Models\Imovel;

class Unidade extends Model
{
	const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    //protected $dateFormat = 'Y-m-d H:i';

    protected $primaryKey = 'UNI_ID';

    protected $guarded = [];


    public function agrupamento()
    {
        return $this->hasOne('App\Models\Agrupamento', 'AGR_ID', 'UNI_IDAGRUPAMENTO');
    }

    public function imovel()
    {
        return $this->hasOne('App\Models\Imovel', 'IMO_ID', 'UNI_IDIMOVEL');
    }

    public function prumada()
    {
    	return $this->hasMany('App\Models\Prumada', 'PRU_IDUNIDADE', 'UNI_ID');
    }

    public function getPrumadas()
    {
    	return $this->hasMany('App\Models\Prumada', 'PRU_IDUNIDADE', 'UNI_ID');
    }

    public function getEquipamentos()
    {
        return $this->hasMany('App\Models\Equipamento', 'EQP_IDUNIDADE', 'UNI_ID');
    }
}
