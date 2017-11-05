<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table = "task";
    
    protected $fillable = [
        'nombre','description','estado','fecha_creacion','fecha_fin','id_usuario','id_proyecto',
    ];
}
