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
        
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('language');
            $table->string('skill');
            $table->string('resume');
            $table->string('resume_public_id');
            $table->longText('description');
            $table->decimal('price', 10, 2);
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->constrained('users')->onDelete(action: 'CASCADE')->onUpdate('CASCADE');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
