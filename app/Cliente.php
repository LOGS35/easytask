<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = "cliente";
    
    protected $fillable = [
        'name','email','telefono',
    ];
}
