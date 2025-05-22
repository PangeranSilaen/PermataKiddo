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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('child_name');  // Mengubah dari name menjadi child_name
            $table->string('registration_number')->nullable();
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->text('address');
            $table->string('parent_name')->nullable();  // Membuat nullable karena parent name bisa diambil dari user
            $table->string('parent_phone');
            $table->string('parent_email')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'accepted'])->default('pending');  // Menambahkan 'accepted' sebagai status yang valid
            $table->text('rejection_reason')->nullable();
            $table->date('registration_date')->default(now());
            $table->string('level')->nullable();  // Menambahkan kolom level
            $table->string('previous_school')->nullable();  // Menambahkan kolom previous_school
            $table->text('notes')->nullable();  // Menambahkan kolom notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
