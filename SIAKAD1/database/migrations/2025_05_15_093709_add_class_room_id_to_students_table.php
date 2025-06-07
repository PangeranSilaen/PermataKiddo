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
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'class_room_id')) {
                $table->foreignId('class_room_id')->nullable()->constrained('class_rooms')->nullOnDelete()->after('user_id');
            }
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
            if (Schema::hasColumn('students', 'class_room_id')) {
                try {
                    // Periksa apakah constraint ada sebelum menghapusnya
                    $constraintExists = DB::select(
                        "SELECT constraint_name 
                         FROM information_schema.table_constraints 
                         WHERE table_name = 'students' 
                         AND constraint_name = 'students_class_room_id_foreign'"
                    );
                    
                    if (!empty($constraintExists)) {
                        $table->dropForeign(['class_room_id']);
                    }
                    
                    $table->dropColumn('class_room_id');
                } catch (\Exception $e) {
                    // Hanya hapus kolom jika constraint tidak dapat dihapus
                    $table->dropColumn('class_room_id');
                }
            }
        });
    }
};
