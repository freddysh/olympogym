<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Congelado extends Model
{
    //
    protected $table = "congelado";
    public function membresia_congelada()
    {
        return $this->belongsTo(Membresia::class, 'membresia_id');
    }
}
