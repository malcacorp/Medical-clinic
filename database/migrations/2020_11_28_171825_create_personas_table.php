<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombres',128)->nullable();
            $table->string('apellido_materno',128)->nullable();
            $table->string('apellido_paterno',128)->nullable();
            $table->string('login',128)->unique()->nullable();
            $table->string('dni',128)->unique()->nullable();
            $table->string('password',128)->nullable();
            $table->enum('rol',['PACIENTE','MEDICO','ADMIN'])->default('PACIENTE');
            $table->string('email',128)->nullable();
            $table->date('fecha_nac')->nullable();
            $table->enum('id_sexo',['Masculino','Femenino'])->nullable();


            $table->text('direccion_nac')->nullable();
            $table->integer('id_pais_nac')->nullable();
            $table->string('ciudad_nac')->nullable();
            $table->integer('id_estado_nac')->nullable();

            $table->text('direccion')->nullable();
            $table->integer('id_pais')->nullable();
            $table->string('ciudad')->nullable();
            $table->integer('id_estado')->nullable();
            $table->string('zip')->nullable();


            $table->string('telefono')->nullable();
            $table->string('ruta_foto',128)->default('user.jpg');
            $table->string('ruta_doc_identidad',128)->default('user.jpg');
            $table->string('grado_instruccion')->nullable();
            $table->integer('id_colegio')->nullable();
            $table->string('num_colegiatura',128)->nullable();
            $table->boolean('es_empleado_ins')->default(false)->nullable();
            
            $table->integer('id_grupo_sanguineo')->nullable();
            $table->boolean('donacion_organos')->default(false);
            $table->integer('ORCID')->nullable();



            $table->integer('id_estado_civil')->nullable();
            $table->integer('id_etnias')->nullable();
            $table->integer('id_religion')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
