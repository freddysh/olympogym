<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    //
    protected $table = "cuota";
    protected $fillable = [
        'id','user_id','membresia_id','fecha_cancelacion','monto','fecha_q_cacelacion', 'estado',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'membresia_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
