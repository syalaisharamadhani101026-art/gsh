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
        Schema::table('stays', function (Blueprint $table) {
            $table->string('transaction_type', 30)->default('room')->after('guest_id'); // 'room' or 'banquet'
            $table->unsignedBigInteger('revenue_amount')->nullable()->after('nights'); // in Rupiah
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stays', function (Blueprint $table) {
            $table->dropColumn(['transaction_type', 'revenue_amount']);
        });
    }
};
