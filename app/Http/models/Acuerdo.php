<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acuerdo extends Model
{
    use SoftDeletes;

    protected $table = 'acuerdos';
    public $timestamps = true;

    protected $fillable = [
        'idMaquinaria',
        'idContrato',
        'idRuta',
        'flete',
        'standBy',
        'horaTarifa',
        'kilometraje',
        'tarifa',
        'modulo',
        'clienteProveedor',
        'observacion',
        'idUsuario',
        'nit',
        'status',
    ];

    protected $casts = [
        'idMaquinaria' => 'integer',
        'idContrato' => 'integer',
        'idRuta' => 'integer',
        'idUsuario' => 'integer',
        'nit' => 'integer',
        'status' => 'integer',
    ];

    public function maquinaria()
    {
        return $this->belongsTo(Maquinaria::class, 'idMaquinaria');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'idContrato');
    }

    public function ruta()
    {
        return $this->belongsTo(Ruta::class, 'idRuta');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'nit');
    }
}
