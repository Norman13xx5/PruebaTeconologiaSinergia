<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'status',
    ];

    protected $casts = [
        'id' => 'integer',
    ];
}