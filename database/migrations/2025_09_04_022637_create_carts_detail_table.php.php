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
       
    Schema::create('carts_detail', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cart_id')->constrained('carts')->cascadeOnDelete();
        $table->foreignId('food_id')->constrained('foods')->restrictOnDelete();
        $table->unsignedInteger('quantity');
        $table->decimal('unit_price', 10, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts_detail');
    }
};
