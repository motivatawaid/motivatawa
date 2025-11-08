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
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('whatsapp_number');
            $table->decimal('price_paid', 10, 2);
            $table->enum('status', ['pending', 'purchased', 'cancelled'])->default('pending');
            $table->string('midtrans_order_id')->nullable()->unique();
            $table->string('midtrans_status')->nullable();
            $table->timestamps();

            $table->index(['course_id', 'user_id']);
            $table->unique(['course_id', 'user_id']); // Satu user satu registrasi per course
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
