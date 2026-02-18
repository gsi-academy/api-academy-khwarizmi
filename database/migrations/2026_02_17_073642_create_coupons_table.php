<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();

            $table->enum('type', ['percentage', 'fixed'])
                  ->default('percentage');

            $table->integer('value'); 
            // contoh:
            // percentage → 10 = 10%
            // fixed → 50000 = Rp 50.000

            $table->integer('limit')->default(100);
            $table->integer('used')->default(0);

            $table->date('expires_at')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
