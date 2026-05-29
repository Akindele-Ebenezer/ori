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
        Schema::create('generators', function (Blueprint $table) {
            $table->id();
            $table->string('Priority_InternalNo')->nullable();
            $table->string('EngineMake')->nullable();
            $table->string('Power')->nullable();
            $table->string('Model')->nullable();
            $table->string('MachineType')->nullable();
            $table->string('SN')->nullable();
            $table->string('EngineType')->nullable();
            $table->string('Location')->nullable();
            $table->string('Remarks')->nullable();
            $table->string('Company')->nullable();
            $table->string('Class')->nullable();
            $table->string('UsedBy')->nullable(); 
            $table->string('Picture')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generators');
    }
};
