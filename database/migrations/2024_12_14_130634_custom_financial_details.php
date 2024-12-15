<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('custom_financial_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('details');
            $table->float('amount', 15, 2); // Floating point number with 2 decimal places
            $table->boolean('is_expense')->default(false);
            $table->boolean('is_income')->default(false);
            $table->boolean('is_transaction')->default(false);
            $table->timestamps();

            // Set up a foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('custom_financial_entries');
    }
};
