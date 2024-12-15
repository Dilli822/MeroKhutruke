<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->float('cash_to_cash', 15, 2)->default(0.00); // Float field with default 0.00
            $table->float('bank_to_bank',15, 2)->default(0.00); // Float field with default 0.00
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
