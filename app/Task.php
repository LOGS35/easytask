<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table = "task";
    
    protected $fillable = [
        'nombre','description','estado','peso','fecha_fin','id_usuario','id_proyecto',
    ];
}
