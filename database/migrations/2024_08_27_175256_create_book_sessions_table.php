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
        Schema::create('book_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('book_session')->nullable();
            $table->decimal('book_session_price', 10 ,2)->default(0);
            $table->string('book_session_time_zone')->nullable();
            $table->string('book_session_date')->nullable();
            $table->string('book_session_time')->nullable();
            $table->boolean('book_session_payment_status')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('mentor_id')->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_sessions');
    }
};
