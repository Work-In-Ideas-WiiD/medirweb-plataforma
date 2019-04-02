<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaturaUnidade extends Model
{
    protected $table = 'faturas_unidades';

    const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    protected $primaryKey = 'FATUNI_ID';

    protected $fillable = [
        'FATUNI_DT', 'FATUNI_IDUNI', 'FATUNI_IDFATURA', 'FATUNI_VALORTOTAL', 'FATUNI_PRUMADAS'
    ];
}
