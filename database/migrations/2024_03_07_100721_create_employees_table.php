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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('EmployeeId')->nullable();
            $table->string('FullName')->nullable();
            $table->string('DateOfBirth')->nullable();
            $table->string('DischargeBook')->nullable();
            $table->string('Location')->nullable();
            $table->string('Rank')->nullable();
            $table->string('Company')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
