<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    //
    protected $table = "membresia";
    protected $fillable = [
        'id','cliente_id','user_id','promocion_id','total','fechaInicio','fechaFin', 'estado',
    ];

    protected $hidden = [
        'remember_token',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function promocion()
    {
        return $this->belongsTo(Promocion::class, 'promocion_id');
    }
    public function cuotas()
    {
        return $this->hasMany(Cuota::class, 'membresia_id');
    }
    public function asistemacias()
    {
        return $this->hasMany(Asistencia::class, 'membresia_id');
    }
    public function congelados()
    {
        return $this->hasMany(Congelado::class, 'membresia_id');
    }
}
