<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'departments';

    protected $fillable = [
        'nombre'
    ];

}