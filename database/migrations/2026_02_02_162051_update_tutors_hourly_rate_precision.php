<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update hourly_rate and price columns to support larger VND values.
     * Previous: decimal(8,2) - max 999,999.99
     * New: decimal(15,2) - max 9,999,999,999,999.99
     */
    public function up(): void
    {
        // Update tutors.hourly_rate
        Schema::table('tutors', function (Blueprint $table) {
            $table->decimal('hourly_rate', 15, 2)->change();
        });

        // Update bookings.price to support VND amounts
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->decimal('hourly_rate', 8, 2)->change();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->change();
        });
    }
};
