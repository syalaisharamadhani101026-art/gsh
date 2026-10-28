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
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained('guests')->cascadeOnDelete();
            $table->string('voucher_code', 50)->unique();
            $table->string('item_title', 150);
            $table->unsignedInteger('item_category'); // 100, 500, 1000
            $table->string('item_detail', 255)->nullable();
            $table->string('selected_option', 150)->nullable(); // e.g. "Payung", "Kipas Portable", etc.
            $table->unsignedInteger('points_cost');
            $table->unsignedInteger('points_before');
            $table->unsignedInteger('points_after');
            $table->string('status', 30)->default('aktif'); // aktif, ditukar, kedaluwarsa
            $table->timestamp('redeemed_at')->useCurrent();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redemptions');
    }
};
