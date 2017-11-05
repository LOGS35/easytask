<?php

namespace EasyTask;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class username extends Model
{
    use Eloquence;

    protected $searchableColumns = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
