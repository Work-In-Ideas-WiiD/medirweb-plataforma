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
        'FATUNI_IDUNI', 'FATUNI_IDFATURA', 'FATUNI_PRUCONSUMO', 'FATUNI_PRUVALOR', 'FATUNI_LEIANTERIOR', 'FATUNI_DTLEIANTERIOR', 'FATUNI_LEIATUAL', 'FATUNI_DTLEIATUAL', 'FATUNI_VALORTOTAL'
    ];
}
