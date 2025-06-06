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
            $table->unsignedBigInteger('class_room_id')->nullable(); // Kolom tetap ada tapi tanpa constraint foreign key
            $table->string('name');
            $table->string('registration_number')->unique();
            $table->date('birth_date');
            $table->string('gender');
            $table->text('address')->nullable();
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('photo')->nullable();
            $table->string('status')->default('active');
            $table->date('join_date')->default(now());
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
