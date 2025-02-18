<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'genres';

    protected $fillable = [
        'nombre'
    ];

}