<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('officer_on_duty_reports', function (Blueprint $table) {
            if (!Schema::hasColumn('officer_on_duty_reports', 'SupervisorSignature')) {
                $table->string('SupervisorSignature')->nullable()->after('Supervisor');
            }
            if (!Schema::hasColumn('officer_on_duty_reports', 'SupervisorAgreement')) {
                $table->string('SupervisorAgreement')->nullable()->after('SupervisorSignature');
            }
        });
    }

    public function down(): void
    {
        Schema::table('officer_on_duty_reports', function (Blueprint $table) {
            $table->dropColumn(['SupervisorSignature', 'SupervisorAgreement']);
        });
    }
};
