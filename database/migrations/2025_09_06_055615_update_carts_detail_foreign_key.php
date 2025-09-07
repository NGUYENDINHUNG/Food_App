<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carts_detail', function (Blueprint $table) {
            // Xóa foreign key cũ
            $table->dropForeign(['food_id']);
            
            // Tạo foreign key mới với cascade
            $table->foreign('food_id')->references('id')->on('foods')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('carts_detail', function (Blueprint $table) {
            $table->dropForeign(['food_id']);
            $table->foreign('food_id')->references('id')->on('foods')->restrictOnDelete();
        });
    }
};