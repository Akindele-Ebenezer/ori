<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('generator_availability', function (Blueprint $table) {
            $table->id();
            $table->integer('GeneratorId')->nullable(); 
            $table->string('EngineMake')->nullable(); 
            $table->string('Location')->nullable(); 
            $table->string('Status')->nullable();
            $table->string('Remarks')->nullable();
            $table->string('DoneBy')->nullable();
            $table->string('StartDate')->nullable();
            $table->string('StartTime')->nullable();
            $table->string('EndDate')->nullable();
            $table->string('EndTime')->nullable();
            $table->string('TillNow')->nullable();
            $table->string('DateIn')->nullable();
            $table->string('TimeIn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generator_availability');
    }
};
