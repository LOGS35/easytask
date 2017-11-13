<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class Equipo_Proyecto extends Model
{
    protected $table = "equipos_proyectos";
    
    protected $fillable = [
        'id_proy','id_equipo',
    ];
}
