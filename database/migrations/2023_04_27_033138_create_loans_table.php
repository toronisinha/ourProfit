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
            $table->unsignedInteger('customer_id');
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('percentage', 5, 2)->default(0);
            $table->decimal('day_profit', 8, 2)->default(0);
            $table->decimal('total_profit', 10, 2)->default(0);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->timestamp('date_from');
            $table->unsignedInteger('timeframe')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1,2 active done');
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
