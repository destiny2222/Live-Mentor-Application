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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('prefer')->nullable();
            $table->boolean('status')->default(false);
            $table->decimal('price',10,2)->default(0);
            $table->string('language')->nullable();
            $table->boolean('level')->default(false);
            $table->time('time')->nullable();
            $table->longText('additional_information')->nullable();
            $table->string('day')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('course_id')->constrained('courses')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('tutor_id')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
