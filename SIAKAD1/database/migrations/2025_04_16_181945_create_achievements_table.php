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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
            // Kolom asli yang mungkin masih digunakan aplikasi
            $table->string('subject');
            $table->string('achievement_type')->nullable(); // Dibuat nullable karena sudah digantikan achievement_description
            $table->decimal('score', 5, 2)->nullable(); // Dibuat nullable karena bentuk score sudah berubah menjadi huruf
            $table->text('description')->nullable();
            $table->date('achievement_date')->nullable();
            $table->string('semester')->nullable();
            $table->string('academic_year');
            
            // Kolom-kolom baru yang digunakan oleh seeder
            $table->string('period')->nullable(); // Kolom yang digunakan seeder untuk menyimpan periode/semester
            $table->text('achievement_description')->nullable(); // Deskripsi capaian pembelajaran
            $table->string('notes')->nullable(); // Catatan tambahan
            $table->date('date_recorded')->nullable(); // Tanggal pencatatan
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
