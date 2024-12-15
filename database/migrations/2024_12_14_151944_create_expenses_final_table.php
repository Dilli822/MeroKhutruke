<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesFinalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses_final', function (Blueprint $table) {
            $table->id();  // Primary key field
            $table->float('expense_transportation', 15, 2)->default(0.00);
            $table->float('expense_refreshment', 15, 2)->default(0.00);
            $table->float('expense_fooding', 15, 2)->default(0.00);
            $table->float('expense_shopping', 15, 2)->default(0.00);
            $table->timestamps();  // Automatically creates created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses_final');
    }
}
