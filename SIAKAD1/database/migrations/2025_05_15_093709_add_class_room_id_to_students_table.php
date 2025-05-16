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
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('class_room_id')->nullable()->constrained('class_rooms')->nullOnDelete()->after('user_id');
        });

        Schema::table('achievements', function (Blueprint $table) {
            if (Schema::hasColumn('achievements', 'score')) {
                $table->dropColumn('score');
            }
            if (Schema::hasColumn('achievements', 'achievement_type')) {
                $table->dropColumn('achievement_type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
