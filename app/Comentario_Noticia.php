<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class Comentario_Noticia extends Model
{
    protected $table = "comentarios_noticias";
    
    protected $fillable = [
        'descripcion','id_noticia','id_user',
    ];
}
