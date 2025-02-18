<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruta extends Model
{
    use SoftDeletes;

    protected $table = 'rutas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'origen',
        'destino',
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
        return $this->hasMany(Acuerdo::class, 'idRuta');
    }
}