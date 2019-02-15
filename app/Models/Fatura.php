<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $table = 'faturas';

    const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    protected $primaryKey = 'FAT_ID';

    protected $fillable = [
        'FAT_IMOID', 'FAT_DTLEIFORNECEDOR', 'FAT_LEIMETRO_FORNECEDOR', 'FAT_LEIMETRO_VALORFORNECEDOR', 'FAT_LEIMETRO_UNI', 'FAT_CONSUMO_IMOVEL', 'FAT_CONSUMO_VALORIMOVEL', 'FAT_CONSUMO_UNI', 'FAT_CONSUMO_VALORUNI', 'FAT_CONSUMO_FORNECEDOR'
    ];
}
