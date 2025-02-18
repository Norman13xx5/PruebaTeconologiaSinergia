<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use SoftDeletes;

    protected $table = 'role';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombreRol',
        'descripcion',
        'status',
    ];

    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
    ];

    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'rolId');
    }
}