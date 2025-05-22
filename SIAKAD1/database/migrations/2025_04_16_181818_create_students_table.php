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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nama_anak');  // Kolom yang diperlukan oleh seeder
            $table->string('name')->nullable();  // Mempertahankan kolom name untuk kompatibilitas
            $table->string('registration_number')->unique()->nullable();
            $table->date('tanggal_lahir');  // Kolom yang diperlukan oleh seeder
            $table->date('birth_date')->nullable();  // Mempertahankan kolom birth_date untuk kompatibilitas
            $table->string('tempat_lahir');  // Kolom yang diperlukan oleh seeder
            $table->string('nik')->nullable();  // Kolom yang diperlukan oleh seeder
            $table->string('jenis_kelamin');  // Kolom yang diperlukan oleh seeder
            $table->string('gender')->nullable();  // Mempertahankan kolom gender untuk kompatibilitas
            $table->string('agama')->nullable();  // Kolom yang diperlukan oleh seeder
            $table->text('alamat')->nullable();  // Kolom yang diperlukan oleh seeder
            $table->text('address')->nullable();  // Mempertahankan kolom address untuk kompatibilitas
            $table->string('nama_ayah');  // Kolom yang diperlukan oleh seeder
            $table->string('nama_ibu');  // Kolom yang diperlukan oleh seeder
            $table->string('pekerjaan_ayah')->nullable();  // Kolom yang diperlukan oleh seeder
            $table->string('pekerjaan_ibu')->nullable();  // Kolom yang diperlukan oleh seeder
            $table->string('parent_name')->nullable();  // Mempertahankan kolom parent_name untuk kompatibilitas
            $table->string('parent_phone')->nullable();  // Mempertahankan kolom untuk kompatibilitas
            $table->string('photo')->nullable();
            $table->string('status')->default('active');
            $table->date('join_date')->nullable()->default(now());  // Membuat nullable dengan default
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
