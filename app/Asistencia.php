<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    //
    protected $table = "asistencia";
    protected $fillable = [
        'id','cliente_id','fecha','hora','estado',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
