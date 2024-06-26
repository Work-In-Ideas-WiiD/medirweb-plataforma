<?php

namespace App;

use Artesaos\Defender\Role;
use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Imovel;
use App\Models\Unidade;

class User extends Authenticatable
{

    use HasDefender, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFotoAttribute($value)
    {
        if ($value) 
            return url("/upload/usuarios/{$value}");

        return url('upload/usuarios/user_default.png');

    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function imovel()
    {
        return $this->belongsTo(Imovel::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
