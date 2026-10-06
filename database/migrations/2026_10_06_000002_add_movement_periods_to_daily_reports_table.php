<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            foreach (['Berthing', 'Unberthing', 'Shifting'] as $movement) {
                $table->date($movement . 'StartDate')->nullable();
                $table->date($movement . 'EndDate')->nullable();
                $table->time($movement . 'StartTime')->nullable();
                $table->time($movement . 'EndTime')->nullable();
            }
        });

        foreach (['Berthing', 'Unberthing', 'Shifting'] as $movement) {
            DB::table('daily_reports')
                ->whereNotNull($movement . 'Date')
                ->update([
                    $movement . 'StartDate' => DB::raw($movement . 'Date'),
                    $movement . 'StartTime' => DB::raw($movement . 'Time'),
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $columns = [];
            foreach (['Berthing', 'Unberthing', 'Shifting'] as $movement) {
                $columns[] = $movement . 'StartDate';
                $columns[] = $movement . 'EndDate';
                $columns[] = $movement . 'StartTime';
                $columns[] = $movement . 'EndTime';
            }

            $table->dropColumn($columns);
        });
    }
};