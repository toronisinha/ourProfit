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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('loan_id')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('due_amount')->nullable();  
            $table->tinyInteger('status')->defult(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
