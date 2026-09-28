<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('device_reports', function (Blueprint $table) {
            if (!Schema::hasColumn('device_reports', 'CCTVDockyard')) {
                $table->string('CCTVDockyard')->default('No')->after('CCTV');
            }
            if (!Schema::hasColumn('device_reports', 'CCTVBullnose')) {
                $table->string('CCTVBullnose')->default('No')->after('CCTVDockyard');
            }
        });

        Schema::create('periodic_checks', function (Blueprint $table) {
            $table->id();
            $table->string('Type');
            $table->string('Equipment');
            $table->string('Location');
            $table->date('Date');
            $table->time('Time');
            $table->string('DoneBy');
            $table->text('Remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodic_checks');
        Schema::table('device_reports', function (Blueprint $table) {
            $columns = [];
            foreach (['CCTVDockyard', 'CCTVBullnose'] as $column) {
                if (Schema::hasColumn('device_reports', $column)) {
                    $columns[] = $column;
                }
            }
            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};