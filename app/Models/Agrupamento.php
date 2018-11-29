<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agrupamento extends Model
{
    protected $table = 'agrupamentos';

    const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    //protected $dateFormat = 'Y-m-d H:i';

    protected $primaryKey = 'AGR_ID';

    protected $fillable = [
        'AGR_IDIMOVEL', 'AGR_NOME', 'AGR_TAXAFIXA', 'AGR_TAXAVARIAVEL'
    ];

    public function imovel()
    {
        return $this->hasOne('App\Models\Imovel', 'IMO_ID', 'AGR_IDIMOVEL');
    }

    public function getUnidades()
    {
        return $this->hasMany('App\Models\Unidade', 'UNI_IDAGRUPAMENTO', 'AGR_ID');
    }
}
