<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('officer_on_duty_reports', function (Blueprint $table) {
            for ($index = 2; $index <= 7; $index++) {
                $table->string('Signature' . $index)->nullable()->after('Signature');
            }
        });
    }

    public function down(): void
    {
        Schema::table('officer_on_duty_reports', function (Blueprint $table) {
            for ($index = 2; $index <= 7; $index++) {
                $table->dropColumn('Signature' . $index);
            }
        });
    }
};