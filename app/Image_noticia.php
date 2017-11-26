<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class image_noticia extends Model
{
    protected $table = "imagenes_noticias";
    
    protected $fillable = [
        'name','id_noticia',
    ];
}
