<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->integer("id_cita");
            $table->text("motivo");
            $table->text("EA");
            $table->text("condiciones");
            $table->text("peso");
            $table->text("talla");
            $table->text("imc");
            $table->text("TA");
            $table->text("FC");
            $table->text("FR");
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
        Schema::dropIfExists('consultas');
    }
}
