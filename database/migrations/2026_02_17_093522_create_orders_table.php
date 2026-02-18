<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('course_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('order_code')->unique();

            $table->decimal('total_price', 15, 2);

            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'cancelled'
            ])->default('pending');

            $table->string('payment_method')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            // 🔥 Optional Index Optimization
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
