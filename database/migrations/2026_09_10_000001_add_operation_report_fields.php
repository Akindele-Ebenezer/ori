<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            foreach (['DeployedVessel1', 'DeployedVessel2', 'DeployedVessel3'] as $column) {
                if (!Schema::hasColumn('daily_reports', $column)) {
                    $table->string($column)->nullable();
                }
            }
        });

        Schema::table('officer_on_duty_reports', function (Blueprint $table) {
            foreach (['Supervisor', 'Signature2', 'Signature3', 'Signature4', 'Signature5', 'Signature6', 'Signature7'] as $column) {
                if (!Schema::hasColumn('officer_on_duty_reports', $column)) {
                    $table->string($column)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->dropColumn(['DeployedVessel1', 'DeployedVessel2', 'DeployedVessel3']);
        });

        Schema::table('officer_on_duty_reports', function (Blueprint $table) {
            $columns = ['Supervisor'];
            for ($index = 2; $index <= 7; $index++) {
                $columns[] = 'Signature' . $index;
            }
            $table->dropColumn($columns);
        });
    }
};