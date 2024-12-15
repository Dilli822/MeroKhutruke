<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('income_details', function (Blueprint $table) {
            $table->id();
            $table->decimal('income_salary', 10, 2)->default(0.00);
            $table->decimal('income_investment', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('income_details');
    }
}