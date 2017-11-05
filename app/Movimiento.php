<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class movimiento extends Model
{
    protected $table = "movimientos";
    
    protected $fillable = [
        'type','movimiento',
    ];
}
