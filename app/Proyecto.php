<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    protected $table = "proyecto";
    
    protected $fillable = [
        'name','fecha_fin','description','estado',
    ];
}
