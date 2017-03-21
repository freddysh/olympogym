<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'dni','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function membresias()
    {
        return $this->hasMany(Membresia::class, 'user_id');
    }
    public function cuotas()
    {
        return $this->hasMany(Cuota::class, 'user_id');
    }
    public function privilegios()
    {
        return $this->hasMany(Privilegio::class, 'user_id');
    }
}
