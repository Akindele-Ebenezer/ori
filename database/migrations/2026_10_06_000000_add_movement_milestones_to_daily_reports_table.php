<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->date('BerthingDate')->nullable();
            $table->time('BerthingTime')->nullable();
            $table->date('UnberthingDate')->nullable();
            $table->time('UnberthingTime')->nullable();
            $table->date('ShiftingDate')->nullable();
            $table->time('ShiftingTime')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->dropColumn([
                'BerthingDate',
                'BerthingTime',
                'UnberthingDate',
                'UnberthingTime',
                'ShiftingDate',
                'ShiftingTime',
            ]);
        });
    }
};