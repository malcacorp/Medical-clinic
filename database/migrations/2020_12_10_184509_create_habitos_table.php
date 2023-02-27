<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitos', function (Blueprint $table) {
            $table->id();
            $table->integer("id_persona");
            $table->boolean("tbq_bool");
            $table->string("tbq_det");
            $table->boolean("alc_bool");
            $table->string("alc_det");
            $table->boolean("drg_bool");
            $table->string("drg_det");
            $table->string("sex");
            $table->string("nut");
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
        Schema::dropIfExists('habitos');
    }
}
