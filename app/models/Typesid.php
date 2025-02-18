<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Typesid extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'typesids';

    protected $fillable = [
        'nombre'
    ];

}