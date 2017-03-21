<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    //
    protected $table = "privilegio";
    protected $fillable = [
        'id','user_id','nombre','estado',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
