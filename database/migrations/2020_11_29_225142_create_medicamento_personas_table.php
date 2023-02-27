<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentoPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamento_personas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_persona');
            $table->integer('id_medicamento');
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->enum('ocurrencia',['NE','PRIMERA','TEMPRANA','TARDIA','RETRAZADA','CRONICA'])->default('NE');
            $table->text('comentario');
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
        Schema::dropIfExists('medicamento_personas');
    }
}
