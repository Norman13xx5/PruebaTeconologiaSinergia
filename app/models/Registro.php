<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    use SoftDeletes;

    protected $table = 'registros';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'idMaquinaria',
        'idContrato',
        'idMaterial',
        'manifiesto',
        'codFicha',
        'movimientos',
        'mts3',
        'peaje',
        'fechaInicio',
        'fechaFin',
        'hraOpInicio',
        'hraOpFin',
        'horometroInicio',
        'horometroFin',
        'observacion',
        'modulo',
        'idUsuario',
        'nit',
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
        'idMaquinaria' => 'integer',
        'idContrato' => 'integer',
        'idMaterial' => 'integer',
        'mts3' => 'float',
        'peaje' => 'float',
        'horometroInicio' => 'float',
        'horometroFin' => 'float',
        'idUsuario' => 'integer',
        'nit' => 'integer',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function maquinaria()
    {
        return $this->belongsTo(Maquinaria::class, 'idMaquinaria');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'idContrato');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'idMaterial');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'nit');
    }

    public function deducibles()
    {
        return $this->hasMany(Deducible::class, 'idRegistro');
    }
}