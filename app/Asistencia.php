<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    //
    protected $table = "asistencia";
    protected $fillable = [
        'id','cliente_id','fecha','hora','estado','membresia_id',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'membresia_id');
    }
}
