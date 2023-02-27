<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatologiaPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patologia_personas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_persona');
            $table->integer('id_patologia');
            $table->date('fecha_ini');
            $table->date('fecha_fin')->nullable();;
            $table->enum('ocurrencia',['NE','PRIMERA','TEMPRANA','TARDIA','RETRAZADA','CRONICA'])->default('NE');
            $table->text('comentario')->nullable();
            $table->enum('desenlace',['NE','CURADO','MEJORADO','PEOR','PENDIENTE','ESTABLE'])->default('NE');
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
        Schema::dropIfExists('patologia_personas');
    }
}
