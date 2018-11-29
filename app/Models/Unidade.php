<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
	const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    protected $dateFormat = 'Y-m-d H:i';

    protected $primaryKey = 'UNI_ID';

    protected $fillable = [
        'UNI_IDAGRUPAMENTO', 'UNI_IDIMOVEL', 'UNI_NOME', 'UNI_RESPONSAVEL', 'UNI_CPFRESPONSAVEL', 'UNI_TELRESPONSAVEL'
    ];


    public function agrupamento()
    {
        return $this->hasOne('App\Models\Agrupamento', 'AGR_ID', 'UNI_IDAGRUPAMENTO');
    }

    public function imovel()
    {
        return $this->hasOne('App\Models\Imovel', 'IMO_ID', 'UNI_IDIMOVEL');
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
