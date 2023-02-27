<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaPruebasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_pruebas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_persona');
            $table->integer('id_prueba');
            $table->date('fecha');
            $table->string('ruta_archivo');
            //$table->date('fecha_fin');
            //$table->enum('ocurrencia',['NE','PRIMERA','TEMPRANA','TARDIA','RETRAZADA','CRONICA'])->default('NE');
            $table->text('comentario');
            //$table->enum('desenlace',['NE','CURADO','MEJORADO','PEOR','PENDIENTE','ESTABLE'])->default('NE');
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
        Schema::dropIfExists('persona_pruebas');
    }
}
