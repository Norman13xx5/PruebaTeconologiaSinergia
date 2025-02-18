<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipality extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'municipalities';

    protected $fillable = [
        'nombre',
        'departamento_id'
    ];

}