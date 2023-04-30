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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('percentage')->nullable();
            $table->decimal('day_profit', 6, 2)->nullable();
            $table->decimal('total_profit', 6, 2)->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('date_from');
            $table->string('timeframe')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
