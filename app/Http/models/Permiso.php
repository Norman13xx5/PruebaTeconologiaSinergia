<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'rolId',
        'moduloId',
        'r',
        'w',
        'u',
        'd',
    ];

    protected $casts = [
        'id' => 'integer',
        'rolId' => 'integer',
        'moduloId' => 'integer',
        'r' => 'integer',
        'w' => 'integer',
        'u' => 'integer',
        'd' => 'integer',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rolId');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'moduloId');
    }
}