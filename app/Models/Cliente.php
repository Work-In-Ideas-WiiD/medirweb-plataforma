<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    /*const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';*/

    protected $primaryKey = 'CLI_ID';

    protected $guarded = [];

    protected  $dates = [
        'created_at', 'updated_at'
    ];

    //protected $dateFormat = 'Y-m-d H:i';

    public function estado()
    {
        return $this->hasOne('App\Models\Estado', 'EST_ID', 'CLI_ESTADO');
    }

    public function cidade()
    {
        return $this->hasOne('App\Models\Cidade', 'CID_ID', 'CLI_CIDADE');
    }

    public function getImoveis(){
        return $this->hasMany('App\Models\Imovel', 'IMO_IDCLIENTE', 'CLI_ID');
    }

}
