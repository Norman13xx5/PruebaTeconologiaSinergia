<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'patients';

    protected $fillable = [
        'tipo_documento_id',
        'numero_documento',
        'nombre1',
        'nombre2',
        'apellido1',
        'apellido2',
        'genero_id',
        'departamento_id',
        'municipio_id'
    ];

}