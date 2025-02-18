<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'salaries';

    protected $primaryKey = 'id';

    protected $fillable = ['userId', 'description', 'amount', 'status'];

    protected $casts = [
        'userId' => 'integer',
        'status' => 'integer'
    ];

    public function salaryUser()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
