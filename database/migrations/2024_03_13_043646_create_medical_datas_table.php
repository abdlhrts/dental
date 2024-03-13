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
        Schema::create('medical_datas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->enum('blood_type', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('blood_pressure_type')->nullable();
            $table->string('heart_disease')->nullable();
            $table->string('diabetes')->nullable();
            $table->string('haemopilia')->nullable();
            $table->string('hepatitis')->nullable();
            $table->string('gastring')->nullable();
            $table->string('other_diseases')->nullable();
            $table->string('drug_allergies')->nullable();
            $table->string('food_allergies')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_datas');
    }
};
