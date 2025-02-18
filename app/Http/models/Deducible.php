<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deducible extends Model
{
    use SoftDeletes;

    protected $table = 'deducibles';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'admon',
        'reteFuente',
        'reteica',
        'anticipo',
        'otros',
        'observacion',
        'idRegistro',
        'idUsuario',
        'nit',
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
        'admon' => 'float',
        'reteFuente' => 'float',
        'reteica' => 'float',
        'anticipo' => 'float',
        'otros' => 'float',
        'idRegistro' => 'integer',
        'idUsuario' => 'integer',
        'nit' => 'integer',
        'status' => 'integer',
        'dateCreated' => 'datetime',
        'dateUpdate' => 'datetime',
        'dateDelete' => 'datetime',
    ];

    public function registro()
    {
        return $this->belongsTo(Registro::class, 'idRegistro');
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