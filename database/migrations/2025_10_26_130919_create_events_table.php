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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['online', 'offline']);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location')->nullable(); // Untuk offline
            $table->integer('quota')->default(0);
            $table->decimal('price', 10, 2)->default(0); // Price dalam Rupiah (decimal untuk presisi)
            $table->string('thumbnail')->nullable(); // Tambahan: Kolom untuk thumbnail
            $table->timestamps();

            $table->index(['talent_id', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
