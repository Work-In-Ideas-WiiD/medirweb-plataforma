<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $table = 'timelines';

    const created_at = 'tempo_criacao';
    const updated_at = 'tempo_alteracao';

    protected $primaryKey = 'TIMELINE_ID';

    protected $guarded = [];
}
