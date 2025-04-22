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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('payment_type'); // SPP, Uniform, Books, etc.
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->nullable();
            $table->date('payment_date');
            $table->string('month')->nullable(); // For monthly payments
            $table->string('academic_year');
            $table->string('receipt_number')->unique();
            $table->text('notes')->nullable();
            $table->string('status')->default('paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
