<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Agrupamento;
use App\Models\Unidade;
use App\User;

class Imovel extends Model
{
    protected $table = 'imoveis';

    const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    //protected $dateFormat = 'Y-m-d H:i';

    protected $primaryKey = 'IMO_ID';

    protected $guarded = [];


    protected  $dates = [
        'created_at', 'updated_at'
    ];

    public function estado()
    {
        return $this->hasOne('App\Models\Estado', 'EST_ID', 'IMO_IDESTADO');
    }

    public function cidade()
    {
        return $this->hasOne('App\Models\Cidade', 'CID_ID', 'IMO_IDCIDADE');
    }

    public function agrupamento()
    {
        return $this->hasMany('App\Models\Agrupamento', 'AGR_IDIMOVEL', 'IMO_ID');
    }

    public function getAgrupamentos(){
        return $this->hasMany('App\Models\Agrupamento', 'AGR_IDIMOVEL', 'IMO_ID');
    }

    public function unidade(){
        return $this->hasMany('App\Models\Unidade', 'UNI_IDIMOVEL', 'IMO_ID');
    }

    public function getUnidades(){
        return $this->hasMany('App\Models\Unidade', 'UNI_IDIMOVEL', 'IMO_ID');
    }

    public function administrador()
    {
        return $this->hasOne('App\Models\Cliente', 'CLI_ID', 'IMO_IDCLIENTE');
    }

    public function users()
    {
    	return $this->hasMany('App\User', 'USER_IMOID', 'IMO_ID');
    }

}
