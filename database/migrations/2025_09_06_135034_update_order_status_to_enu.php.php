<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', [
                'pending',      // Chờ xác nhận
                'confirmed',    // Đã xác nhận
                'shipping',     // Đang giao hàng
            ])->default('pending')->change();
        });

        // Cập nhật dữ liệu hiện tại nếu có
        DB::table('orders')->whereNull('status')->update(['status' => 'pending']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Chuyển lại thành string
            $table->string('status')->change();
            $table->string('payment_status')->change();
        });
    }
};