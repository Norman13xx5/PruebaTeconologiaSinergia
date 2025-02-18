<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maquinaria extends Model
{
    use SoftDeletes;

    protected $table = 'maquinarias';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'placa',
        'marca',
        'referencia',
        'modelo',
        'color',
        'capacidad',
        'nroSerie',
        'nroSerieChasis',
        'nroMotor',
        'rodaje',
        'run',
        'gps',
        'fechaSoat',
        'fechaTecno',
        'propietario',
        'documentoPropietario',
        'telefonoPropietario',
        'correoPropietario',
        'operador',
        'documentOperador',
        'telefonOperador',
        'correOperador',
        'contentType',
        'base64',
        'idTpMaquinaria',
        'idUsuario',
        'nit',
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
        'idTpMaquinaria' => 'integer',
        'idUsuario' => 'integer',
        'nit' => 'integer',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function tipoMaquinaria()
    {
        return $this->belongsTo(TipoMaquinaria::class, 'idTpMaquinaria');
    }

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
        return $this->hasMany(Acuerdo::class, 'idMaquinaria');
    }
}