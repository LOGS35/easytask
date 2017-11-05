<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class noticia extends Model
{
    protected $table = "noticias";
    
    protected $fillable = [
        'title','content','user_id',
    ];
}
