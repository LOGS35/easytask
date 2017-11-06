<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class comentario_task extends Model
{
    protected $table = "comentarios_proyecto";
    
    protected $fillable = [
        'descripcion','id_task','id_user',
    ];
}
