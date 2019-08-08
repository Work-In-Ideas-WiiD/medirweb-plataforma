<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Leitura extends Model
{
    protected $guarded = [];

    protected  $dates = [
        'created_at', 'updated_at'
    ];

    public function prumada()
    {
    	return $this->hasOne('App\Models\Prumada');

    }


    public function scopeByLeituraexport($query, $value)
    {
        return $query->select('imoveis.IMO_NOME as imovel', 'unidades.UNI_NOME as unidade', 'prumadas.PRU_IDUNIDADE as prumada', 'leituras.LEI_METRO as metros_cubicos', 'leituras.LEI_LITRO as litros', 'leituras.LEI_MILILITRO as mililitros', 'leituras.created_at as data_registro')
            ->join('prumadas', 'prumadas.PRU_ID', '=', 'leituras.LEI_IDPRUMADA')
            ->join('unidades', 'unidades.UNI_ID', '=', 'prumadas.PRU_IDUNIDADE')
            ->join('imoveis', 'imoveis.IMO_ID', '=', 'unidades.UNI_IDIMOVEL')
            ->where('imoveis.IMO_ID', '=', $value)
            ->where('leituras.created_at', '>=', date('2019-01-22').' 17:13:18')
            ->where('leituras.created_at', '<=', date('2019-01-22').' 17:21:50')
            ->orderBy('unidades.UNI_NOME', 'asc')
            ->get();
    }

}
