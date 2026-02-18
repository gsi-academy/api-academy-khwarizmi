<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zoom_meetings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('title');
            $table->string('mentor_name');
            $table->dateTime('scheduled_at');
            $table->string('zoom_link');
            $table->string('meeting_id')->nullable();
            $table->string('passcode')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zoom_meetings');
    }
};
