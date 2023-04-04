<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_assessments', function (Blueprint $table) {
          $table->id();
          $table->bigInteger('patient_id')->nullable()->unsigned();
          $table->bigInteger('employee_id')->nullable()->unsigned(); //Doctor id on employees table
          $table->string('assessment_type')->nullable();

          $table->float('height')->nullable();
          $table->float('weight')->nullable();
          $table->string('temperature')->nullable();
          $table->string('blood_pressure')->nullable();
          $table->text('medical_condition')->nullable();
          
          $table->text('medical_history')->nullable();
          $table->boolean('alergic')->nullable();
          $table->text('alergies')->nullable();
          $table->text('medical_concerns')->nullable();
          $table->text('diagnostic')->nullable();
          $table->text('treatment')->nullable();

          $table->boolean('active')->nullable();
          $table->timestamps();
          $table->foreign('patient_id')->references('id')->on('patients');
          $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_assessments');
    }
};
