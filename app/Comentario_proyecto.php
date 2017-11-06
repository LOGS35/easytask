<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class comentario_proyecto extends Model
{
    protected $table = "comentarios_proyecto";
    
    protected $fillable = [
        'descripcion','id_proyecto','id_user',
    ];
}
