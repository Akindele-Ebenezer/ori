<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('availability_reports', function (Blueprint $table) {
            if (!Schema::hasColumn('availability_reports', 'Attachment')) {
                $table->string('Attachment')->nullable()->after('Remarks');
            }
        });
    }

    public function down(): void
    {
        Schema::table('availability_reports', function (Blueprint $table) {
            if (Schema::hasColumn('availability_reports', 'Attachment')) {
                $table->dropColumn('Attachment');
            }
        });
    }
};
