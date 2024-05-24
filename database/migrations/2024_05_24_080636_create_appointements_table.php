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
        Schema::create('appointements', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datetime');
            $table->string('appointment_id')->unique();
            $table->string('patient_name');
            $table->string('consultation_mode');
            $table->string('payment_mode');
            $table->string('payment_status');
            $table->integer('age_years');
            $table->integer('age_months');
            $table->dateTime('appointment_date');
            $table->string('appointment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointements');
    }
};
