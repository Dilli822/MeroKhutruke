<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_finance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('details');
            $table->decimal('amount', 15, 2); // Use decimal for financial precision
            $table->boolean('is_expense')->default(false);
            $table->boolean('is_income')->default(false);
            $table->boolean('is_transaction')->default(false);
            $table->date('entry_date'); // Default to current date if not provided
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_financial_entries');
    }
};
