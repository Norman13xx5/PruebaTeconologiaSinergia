<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMaquinaria extends Model
{
    protected $table = 'tipo_maquinaria';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tipo',
        'descripcion',
    ];

    protected $casts = [
        'id' => 'integer',
    ];
}