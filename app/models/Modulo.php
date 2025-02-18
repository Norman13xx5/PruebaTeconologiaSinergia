<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modules';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'menuId',
        'page',
        'titulo',
        'icono',
        'descripcion',
        'status',
    ];

    protected $casts = [
        'menuId' => 'integer',
        'status' => 'integer',
    ];

    public function parentModulo()
    {
        return $this->belongsTo(Modulo::class, 'menuId');
    }

    public function childModulos()
    {
        return $this->hasMany(Modulo::class, 'menuId');
    }
}