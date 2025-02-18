<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use SoftDeletes;

    protected $table = 'contratos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'fechaInicio',
        'fechaFin',
        'titulo',
        'representante',
        'telefono',
        'email',
        'contentType',
        'base64',
        'idUsuario',
        'nit',
        'status',
    ];

    protected $casts = [
        'id' => 'integer',
        'idUsuario' => 'integer',
        'nit' => 'integer',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'nit');
    }

    public function acuerdos()
    {
        return $this->hasMany(Acuerdo::class, 'idContrato');
    }
}