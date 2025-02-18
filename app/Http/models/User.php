<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'nit',
        'identificacion',
        'nombres',
        'aPaterno',
        'aMaterno',
        'telefono',
        'emailUser',
        'pswd',
        'nombreFiscal',
        'direccionFiscal',
        'contentType',
        'base64',
        'rolId',
        'status',
    ];

    protected $hidden = [
        'pswd',
    ];

    protected $casts = [
        'id' => 'integer',
        'nit' => 'integer',
        'rolId' => 'integer',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rolId');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'nit');
    }
}