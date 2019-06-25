<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fechamento extends Model
{
    protected $table = 'fechamentos';

    protected $primaryKey = 'FEC_ID';

    protected $fillable = [
        'FEC_ID','FEC_IDPRUMADA', 'FEC_VALOR', 'FEC_METRO', 'FEC_LITRO', 'FEC_MILILITRO','FEC_DIFERENCA'
        ];

    protected  $dates = [
        'created_at', 'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function prumada()
    {
    	return $this->hasOne('App\Models\Prumada', 'PRU_ID', 'LEI_IDPRUMADA');

    }
}
