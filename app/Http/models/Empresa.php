<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;
    protected $table = 'companies';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'nit',
        'digito',
        'nombre',
        'representante',
        'telefono',
        'direccion',
        'correo',
        'pais',
        'ciudad',
        'contacto',
        'emailTec',
        'emailLogis',
        'contentType',
        'base64',
        'fechaInicio',
        'fechaCorte',
        'status',
    ];

    // Cast de tipos de datos
    protected $casts = [
        'nit' => 'integer',
        'digito' => 'integer',
        'status' => 'integer',
        'fechaInicio' => 'date',
        'fechaCorte' => 'date',
    ];
}
