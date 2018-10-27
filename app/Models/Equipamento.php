<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    protected $table = 'equipamentos';

    const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    protected $dateFormat = 'Y-m-d H:i';

    protected $primaryKey = 'EQP_ID';

    protected $fillable = [
        'EQP_IDFUNCIONAL', 'EQP_SERIAL', 'EQP_FABRICANTE', 'EQP_MODELO', 'EQP_OPERADORA', 'EQP_STATUS'
    ];

    protected  $dates = [
        'created_at', 'updated_at'
    ];
}
