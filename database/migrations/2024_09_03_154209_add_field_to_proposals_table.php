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
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('zoom_meeting_id')->nullable();
            $table->string('zoom_meeting_password')->nullable();
            $table->longText('zoom_meeting_url')->nullable();
            $table->date('zoom_meeting_start_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('zoom_meeting_id');
            $table->dropColumn('zoom_meeting_password');
            $table->dropColumn('zoom_meeting_url');
            $table->dropColumn('zoom_meeting_start_time');
        });
    }
};
