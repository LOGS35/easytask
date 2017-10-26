<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movimiento extends Model
{
    protected $table = "movimientos";
    
    protected $fillable = [
        'type','movimiento',
    ];
}
