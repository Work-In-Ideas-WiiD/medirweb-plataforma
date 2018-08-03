<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Agrupamento;
use App\Models\Unidade;

class Imovel extends Model
{    
    protected $table = 'imoveis';

    const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $primaryKey = 'IMO_ID';

    protected $fillable = [
        'IMO_NOME', 'IMO_ENDERECO', 'IMO_COMPLEMENTO', 'IMO_NUMERO', 'IMO_NUMERO', 'IMO_BAIRRO', 'IMO_CIDADE', 'IMO_ESTADO', 'IMO_CEP', 'IMO_RESPONSAVEIS'.'IMO_TELEFONES'
    ];

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

    public function getAgrupamentos(){
        return $this->hasMany('App\Models\Agrupamento', 'AGR_IDIMOVEL', 'IMO_ID');
    }

    public function getUnidades(){
        return $this->hasMany('App\Models\Unidade', 'UNI_IDIMOVEL', 'IMO_ID');
    }

}
