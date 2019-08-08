<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected  $dates = [
        'created_at', 'updated_at'
    ];

    //protected $dateFormat = 'Y-m-d H:i';

    public function estado()
    {
        return $this->hasOne('App\Models\Estado');
    }

    public function cidade()
    {
        return $this->hasOne('App\Models\Cidade');
    }

    public function getImoveis(){
        return $this->hasMany('App\Models\Imovel');
    }

}
