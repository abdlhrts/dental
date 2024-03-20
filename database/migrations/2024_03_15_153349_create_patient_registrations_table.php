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
        Schema::create('patient_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->foreignId('patient_id');
            $table->foreignId('user_id');
            $table->enum('registration_status', ['waiting', 'treated', 'already home'])->default('waiting');
            $table->dateTime('admission_date')->nullable();
            $table->dateTime('discharge_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_registrations');
    }
};
