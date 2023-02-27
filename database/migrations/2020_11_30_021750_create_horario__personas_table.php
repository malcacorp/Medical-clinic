<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario__personas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_persona');
            $table->integer('id_horario');
            $table->enum('dias',['LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO','DOMINGO']);
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
        Schema::dropIfExists('horario__personas');
    }
}
