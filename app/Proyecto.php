<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    protected $table = "proyecto";
    
    protected $fillable = [
        'name','fecha_inicio','fecha_fin','description','estado','comentarios',
    ];
}
