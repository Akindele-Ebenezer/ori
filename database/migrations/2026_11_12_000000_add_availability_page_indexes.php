<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vessel_availabilities', function (Blueprint $table) {
            $table->index(['Vessel', 'StartDate'], 'vessel_availabilities_vessel_start_date_index');
            $table->index(['Vessel', 'EndDate'], 'vessel_availabilities_vessel_end_date_index');
            $table->index(['Status', 'StartDate'], 'vessel_availabilities_status_start_date_index');
            $table->index('TillNow', 'vessel_availabilities_till_now_index');
        });

        Schema::table('other_reports', function (Blueprint $table) {
            $table->index(['Vessel', 'Date'], 'other_reports_vessel_date_index');
        });

        Schema::table('generator_availability', function (Blueprint $table) {
            $table->index(['GeneratorId', 'EndDate'], 'generator_availability_generator_end_date_index');
            $table->index(['EngineMake', 'StartDate'], 'generator_availability_engine_start_date_index');
            $table->index('TillNow', 'generator_availability_till_now_index');
        });

        foreach (['checklist_1a', 'checklist_1b', 'checklist_1c', 'checklist_1d', 'checklist_1e'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $table->index(['Boat', 'Date'], $tableName . '_boat_date_index');
            });
        }
    }

    public function down(): void
    {
        Schema::table('vessel_availabilities', function (Blueprint $table) {
            $table->dropIndex('vessel_availabilities_vessel_start_date_index');
            $table->dropIndex('vessel_availabilities_vessel_end_date_index');
            $table->dropIndex('vessel_availabilities_status_start_date_index');
            $table->dropIndex('vessel_availabilities_till_now_index');
        });

        Schema::table('other_reports', function (Blueprint $table) {
            $table->dropIndex('other_reports_vessel_date_index');
        });

        Schema::table('generator_availability', function (Blueprint $table) {
            $table->dropIndex('generator_availability_generator_end_date_index');
            $table->dropIndex('generator_availability_engine_start_date_index');
            $table->dropIndex('generator_availability_till_now_index');
        });

        foreach (['checklist_1a', 'checklist_1b', 'checklist_1c', 'checklist_1d', 'checklist_1e'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $table->dropIndex($tableName . '_boat_date_index');
            });
        }
    }
};
