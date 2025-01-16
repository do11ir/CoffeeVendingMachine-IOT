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
        Schema::create('order_drink', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Link to orders
            $table->foreignId('drink_id')->constrained('drinks')->onDelete('cascade'); // Link to drinks
            $table->integer('quantity')->default(1); // Number of drinks in this order
            $table->timestamps(); // For tracking created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_drink');
    }
};
