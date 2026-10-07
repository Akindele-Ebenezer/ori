<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('availability_reports', function (Blueprint $table) {
            $table->string('Type')->nullable();
            $table->string('Office')->nullable();
            $table->string('Driver')->nullable();
            $table->string('Lodging')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('availability_reports', function (Blueprint $table) {
            $table->dropColumn(['Type', 'Office', 'Driver', 'Lodging']);
        });
    }
};
