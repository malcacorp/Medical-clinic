<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmunizacionPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmunizacion__personas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_persona');
            $table->integer('id_inmunizacion');
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->enum('fuente',['NE','NUEVA','AGENCIAP','TARJETA','HC','PADRES','PACIENTE'])->default('NE');
            $table->enum('estatus',['NE','COMPLETO','NOADM','PARCIAL','RECHAZADO'])->default('NE');
            $table->text('comentario');
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
        Schema::dropIfExists('inmunizacion__personas');
    }
}
