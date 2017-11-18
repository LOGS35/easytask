<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    protected $table = "proyecto";
    
    protected $fillable = [
        'name','fecha_fin','description','estado','id_equipo',
    ];
    
    public function scopeEstado($query, $estado) {
        $query->where('estado', 'LIKE', "%$estado%");
    }
}
