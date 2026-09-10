<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id(); $table->string('Vessel')->nullable(); $table->string('Status'); $table->string('DoneBy'); $table->text('Remarks')->nullable(); $table->string('StartTime')->nullable(); $table->string('EndTime')->nullable(); $table->date('StartDate'); $table->date('EndDate'); $table->string('TillNow')->default('NO'); $table->date('DateIn')->nullable(); $table->string('TimeIn')->nullable(); $table->timestamps();
        });
        Schema::create('radio_broadcast_reports', function (Blueprint $table) {
            $table->id(); $table->string('Vessel'); $table->string('DoneBy'); $table->text('Remarks')->nullable(); $table->date('Date'); foreach (['WatchKeepingAlert', 'RelatedDistress', 'FirstCallTime', 'SecondCallTime', 'Responders'] as $field) $table->string($field)->default('No'); $table->date('DateIn')->nullable(); $table->string('TimeIn')->nullable(); $table->timestamps();
        });
        Schema::create('device_reports', function (Blueprint $table) {
            $table->id(); foreach (['VhfBaseRadio', 'VhfHandHeld', 'Ais', 'VhfRecorder', 'WindDetector', 'StormDetector', 'ComputerSystem', 'PublicAddressSystem', 'FireAlarmSystem', 'VoltageRegulator', 'VhfRepeater', 'MobilePhone', 'Intercomm', 'CCTV', 'Internet'] as $field) $table->string($field)->default('No'); $table->string('DoneBy'); $table->text('Remarks')->nullable(); $table->date('Date'); $table->date('DateIn')->nullable(); $table->string('TimeIn')->nullable(); $table->timestamps();
        });
        Schema::create('officer_on_duty_reports', function (Blueprint $table) {
            $table->id(); for ($index = 1; $index <= 7; $index++) { $suffix = $index === 1 ? '' : $index; $table->string('Name' . $suffix)->nullable(); $table->string('Morning' . $suffix)->default('No'); $table->string('Afternoon' . $suffix)->default('No'); $table->string('Night' . $suffix)->default('No'); } $table->string('Signature')->nullable(); $table->text('Remarks')->nullable(); $table->date('Date'); $table->date('DateIn')->nullable(); $table->string('TimeIn')->nullable(); $table->timestamps();
        });
        Schema::create('other_reports', function (Blueprint $table) {
            $table->id(); $table->string('Vessel'); $table->string('ROB'); $table->string('FreshWater'); $table->string('DoneBy'); $table->text('Remarks')->nullable(); $table->date('Date'); $table->date('DateIn')->nullable(); $table->string('TimeIn')->nullable(); $table->timestamps();
        });
    }

    public function down(): void
    {
        foreach (['other_reports', 'officer_on_duty_reports', 'device_reports', 'radio_broadcast_reports', 'daily_reports'] as $table) Schema::dropIfExists($table);
    }
};