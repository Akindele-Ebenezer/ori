<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            foreach (['Berthing', 'Unberthing', 'Shifting'] as $movement) {
                foreach (range(1, 3) as $index) {
                    $table->string($movement . 'DeployedVessel' . $index)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $columns = [];
            foreach (['Berthing', 'Unberthing', 'Shifting'] as $movement) {
                foreach (range(1, 3) as $index) {
                    $columns[] = $movement . 'DeployedVessel' . $index;
                }
            }

            $table->dropColumn($columns);
        });
    }
};