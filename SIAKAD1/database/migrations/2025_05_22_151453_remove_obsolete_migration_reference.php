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
        // Hapus referensi migrasi yang tidak ada dari tabel migrations
        DB::table('migrations')
            ->where('migration', '2025_05_16_051636_remove_score_and_achievement_type_from_achievements_table')
            ->delete();
    }

    /**
     * Reverse the migrations.
     * Karena ini adalah migrasi pembersihan, kita tidak perlu mengembalikan
     * referensi yang sengaja dihapus.
     */
    public function down(): void
    {
        // Tidak perlu melakukan apa-apa karena kita ingin menghapus referensi secara permanen
    }
};
