<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            if (!Schema::hasColumn('daily_reports', 'VesselRemark')) {
                $table->text('VesselRemark')->nullable()->after('Vessel');
            }
        });

        Schema::table('vessel_availabilities', function (Blueprint $table) {
            if (!Schema::hasColumn('vessel_availabilities', 'Remark')) {
                $table->text('Remark')->nullable()->after('Vessel');
            }
        });

        Schema::table('device_reports', function (Blueprint $table) {
            if (!Schema::hasColumn('device_reports', 'Time')) {
                $table->string('Time')->nullable()->after('Date');
            }
        });

        Schema::create('availability_reports', function (Blueprint $table) {
            $table->id();
            $table->string('ReportType');
            $table->string('PersonVesselInvolved')->nullable();
            $table->string('NatureOf')->nullable();
            $table->string('Location')->nullable();
            $table->string('AidRequired')->nullable();
            $table->string('SalvageTugs')->nullable();
            $table->string('Name')->nullable();
            $table->string('VesselOffice')->nullable();
            $table->string('Admission')->nullable();
            $table->string('DepartureTime')->nullable();
            $table->string('ArrivalTime')->nullable();
            $table->string('Vessel')->nullable();
            $table->string('NoOfJobs')->nullable();
            $table->string('NavyJobs')->nullable();
            $table->string('Tugs')->nullable();
            $table->date('Date')->nullable();
            $table->string('Time')->nullable();
            $table->string('DoneBy')->nullable();
            $table->text('Remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('availability_reports');
        Schema::table('device_reports', fn (Blueprint $table) => $table->dropColumn('Time'));
        Schema::table('vessel_availabilities', fn (Blueprint $table) => $table->dropColumn('Remark'));
        Schema::table('daily_reports', fn (Blueprint $table) => $table->dropColumn('VesselRemark'));
    }
};
