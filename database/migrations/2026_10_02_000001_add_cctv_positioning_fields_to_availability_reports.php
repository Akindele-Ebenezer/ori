<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('availability_reports', function (Blueprint $table) {
            $table->string('RecordingCapacity')->nullable();
            $table->string('Positioning')->nullable();
            $table->string('Correction')->nullable();
            $table->string('From')->nullable();
            $table->string('To')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('availability_reports', function (Blueprint $table) {
            $table->dropColumn(['RecordingCapacity', 'Positioning', 'Correction', 'From', 'To']);
        });
    }
};