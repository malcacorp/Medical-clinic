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
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->string('id_number',20)->unique()->nullable();
            $table->string('first_name',128)->nullable();
            $table->string('last_name',128)->nullable();
            $table->enum('sex',['Male','Female'])->nullable();
            $table->string('email',128)->nullable();
            $table->string('phone_number')->nullable();
            $table->date('birthdate')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('eye_color')->nullable();
            $table->text('address')->nullable();

            $table->text('medical_condition')->nullable();

            // $table->text('birth_place')->nullable();
            // $table->string('grade')->nullable();
            // $table->string('city')->nullable();


            // $table->integer('id_pais_nac')->nullable();
            // $table->string('birth_city')->nullable();
            // $table->integer('id_estado_nac')->nullable();

            // $table->integer('id_pais')->nullable();
            // $table->integer('id_estado')->nullable();
            // $table->string('zip')->nullable();


            // $table->string('ruta_foto',128)->default('user.jpg');
            // $table->string('ruta_doc_identidad',128)->default('user.jpg');
            // $table->integer('id_colegio')->nullable();
            // $table->string('num_colegiatura',128)->nullable();
            // $table->boolean('es_empleado_ins')->default(false)->nullable();
            
            // $table->integer('id_grupo_sanguineo')->nullable();
            // $table->boolean('donacion_organos')->default(false);
            // $table->integer('ORCID')->nullable();



            // $table->integer('id_estado_civil')->nullable();
            // $table->integer('id_etnias')->nullable();
            // $table->integer('id_religion')->nullable();
            // $table->boolean('status')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
