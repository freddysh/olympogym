<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $table = "cliente";
    protected $fillable = [
        'id','dni','nombres',
        'apellidos', 'direccion','telefono','email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'cliente_id');
    }
    public function membresias()
    {
        return $this->hasMany(Membresia::class, 'cliente_id');
    }
}
