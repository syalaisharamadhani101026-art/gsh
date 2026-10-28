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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('member_number', 50)->unique();
            $table->string('name', 150);
            $table->string('phone', 50)->index();
            $table->string('tier', 20)->default('Silver'); // Silver, Gold, Platinum
            $table->unsignedInteger('points')->default(0);
            $table->timestamps();
        });

        Schema::create('stays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained('guests')->cascadeOnDelete();
            $table->string('booking_code', 50)->unique();
            $table->string('room_type', 50); // Deluxe, Executive, Royal Suite, President Suite
            $table->unsignedInteger('points_per_night');
            $table->unsignedInteger('nights');
            $table->unsignedInteger('points_earned'); // Kamar x Malam
            $table->unsignedInteger('points_added'); // Poin riil yang bertambah setelah perhitungan cap
            $table->date('stay_date')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stays');
        Schema::dropIfExists('guests');
    }
};
