<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFinanceDetails extends Model
{
    use HasFactory;
    protected $table = 'custom_finance_details'; // Explicitly map the table name
    // The table associated with the model
    public $timestamps = false; 
    // Mass assignable attributes
    protected $fillable = ['user_id', 'details', 'amount', 'is_expense', 'is_income', 'is_transaction', 'entry_date'];

    // Relationship with the User model (optional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
