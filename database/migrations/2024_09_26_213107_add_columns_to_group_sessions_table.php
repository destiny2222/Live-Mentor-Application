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
        Schema::table('group_sessions', function (Blueprint $table) {
            $table->LongText('zoom_meeting_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_sessions', function (Blueprint $table) {
            $table->dropColumn('zoom_meeting_link');
        });
    }
};
