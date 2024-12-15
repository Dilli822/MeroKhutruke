<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesFinal extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_transportation',
        'expense_refreshment',
        'expense_fooding',
        'expense_shopping',
    ];
}
