<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'expenses';

    protected $primaryKey = 'id';

    protected $fillable = ['categoryId', 'description', 'amount',];

    protected $casts = [
        'categoryId' => 'integer',
        'status' => 'integer'
    ];

    public function expenseCategory()
    {
        return $this->belongsTo(Category::class, 'categoryId');

    }
}
