<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $table = 'companies';
    protected $primaryKey = 'nit';
    protected $dates = ['deleted_at'];
    public $timestamps = true;

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

    protected $casts = [
        'nit' => 'integer',
        'digito' => 'integer',
        'status' => 'integer',
    ];
}