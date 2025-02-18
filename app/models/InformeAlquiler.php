<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformeAlquiler extends Model
{
    protected $table = 'informe_alquiler';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idMaquinaria',
        'idContrato',
        'codFicha',
        'placa',
        'manifiesto',
        'titulo',
        'fechaInicio',
        'fechaFin',
        'titulo',
        'hraOpInicio',
        'hraOpFin',
        'horometroInicio',
        'horometroFin',
        'totalHoras',
        'standBy',
        'tarifa',
        'subTotal',
        'admon',
        'reteFuente',
        'reteica',
        'anticipo',
        'otros',
        'total',
        'clienteProveedor',
        'nit',
    ];

    protected $casts = [
        'id' => 'integer',
    ];
}