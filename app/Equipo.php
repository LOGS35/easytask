<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class equipo extends Model
{   
    use Eloquence;

    protected $searchableColumns = ['nombre'];
    
    protected $table = "equipo";
    
    protected $fillable = [
        'nombre','estado',
    ];
}
