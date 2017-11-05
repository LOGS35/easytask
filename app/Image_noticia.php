<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class image_noticia extends Model
{
    protected $table = "images_noticias";
    
    protected $fillable = [
        'name','id_noticia',
    ];
}
