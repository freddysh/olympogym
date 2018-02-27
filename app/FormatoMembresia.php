<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormatoMembresia extends Model
{
    //
    protected $table = "formato_membresia";
    public function formato()
    {
        return $this->belongsTo(FormatoMembresia::class, 'membresia_id');
    }
}
