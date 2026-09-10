<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('other_reports', function (Blueprint $table) {
            $table->string('CCTV')->default('No')->after('FreshWater');
            $table->string('Internet')->default('No')->after('CCTV');
        });
    }

    public function down(): void
    {
        Schema::table('other_reports', function (Blueprint $table) {
            $table->dropColumn(['CCTV', 'Internet']);
        });
    }
};