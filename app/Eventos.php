<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    //
    protected $table = "eventos";
    protected $hidden = [
        'remember_token',
    ];

    public function membresia()
    {
        return $this->belongsTo(Eventos::class, 'membresia_id');
    }
    public function eventos()
    {
        return $this->belongsTo(Eventos::class, 'user_id');
    }
}
