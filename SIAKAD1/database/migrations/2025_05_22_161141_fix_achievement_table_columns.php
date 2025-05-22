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
        Schema::table('achievements', function (Blueprint $table) {
            // Hapus kolom score numerik jika sudah ada (karena kita akan menggunakan string)
            if (Schema::hasColumn('achievements', 'score')) {
                $table->dropColumn('score');
            }
            
            // Tambahkan kolom-kolom yang diperlukan oleh seeder jika belum ada
            if (!Schema::hasColumn('achievements', 'period')) {
                $table->string('period')->nullable();
            }
            
            if (!Schema::hasColumn('achievements', 'achievement_description')) {
                $table->text('achievement_description')->nullable();
            }
            
            // Tambahkan score sebagai string, bukan decimal
            if (!Schema::hasColumn('achievements', 'score')) {
                $table->string('score')->nullable();
            }
            
            if (!Schema::hasColumn('achievements', 'notes')) {
                $table->string('notes')->nullable();
            }
            
            if (!Schema::hasColumn('achievements', 'date_recorded')) {
                $table->date('date_recorded')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            // Kembalikan ke struktur awal jika diperlukan
            $table->dropColumn([
                'period', 
                'achievement_description', 
                'score', 
                'notes', 
                'date_recorded'
            ]);
        });
    }
};
