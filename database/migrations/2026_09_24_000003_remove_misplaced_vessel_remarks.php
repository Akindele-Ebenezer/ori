<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('daily_reports', 'VesselRemark')) {
            Schema::table('daily_reports', fn (Blueprint $table) => $table->dropColumn('VesselRemark'));
        }

        if (Schema::hasColumn('vessel_availabilities', 'Remark')) {
            Schema::table('vessel_availabilities', fn (Blueprint $table) => $table->dropColumn('Remark'));
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('daily_reports', 'VesselRemark')) {
            Schema::table('daily_reports', fn (Blueprint $table) => $table->text('VesselRemark')->nullable()->after('Vessel'));
        }

        if (!Schema::hasColumn('vessel_availabilities', 'Remark')) {
            Schema::table('vessel_availabilities', fn (Blueprint $table) => $table->text('Remark')->nullable()->after('Vessel'));
        }
    }
};
