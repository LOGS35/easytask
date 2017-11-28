<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class proyecto extends Model
{
    use Eloquence;

    protected $searchableColumns = ['name'];
    
    protected $table = "proyecto";
    
    protected $fillable = [
        'name','fecha_fin','description','estado','id_equipo',
    ];
    
    public function scopeEstado($query, $estado) {
        $query->where('estado', 'LIKE', "%$estado%");
    }
}
