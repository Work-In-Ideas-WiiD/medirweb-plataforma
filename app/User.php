<?php

namespace App;

use Artesaos\Defender\Role;
use Artesaos\Defender\Traits\HasDefender;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Imovel;

class User extends Authenticatable
{

    use HasDefender, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'USER_IMOID', 'USER_UNIID', 'foto', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function imovel()
    {
        return $this->hasOne('App\Models\Imovel', 'IMO_ID', 'USER_IMOID');
    }
}
