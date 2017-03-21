<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = "promocion";
    protected $fillable = [
        'id','titulo','detalle','precio','tipoDuracion','duracion','estado',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function membresias()
    {
        return $this->hasMany(Membresia::class, 'promocion_id');
    }
}
