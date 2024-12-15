<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'transfers';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'cash_to_cash',
        'bank_to_bank',
    ];

    // Optionally, you can define default values for cash_to_cash and bank_to_bank
    protected $attributes = [
        'cash_to_cash' => 0.00,
        'bank_to_bank' => 0.00,
    ];
}
