<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = ['userId', 'description', 'status'];

    protected $casts = [
        'userId' => 'integer',
        'status' => 'integer'
    ];

    public function categoryUser()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
