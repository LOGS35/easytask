<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class equipo extends Model
{
    protected $table = "equipo";
    
    protected $fillable = [
        'nombre','estado','id_proy',
    ];
}
