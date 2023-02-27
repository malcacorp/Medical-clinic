<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            /*$table->enum('horarios',['de 8:00 a 9:00','de 9:00 a 10:00', 'de 10:00 a 11:00',
                                    'de 11:00 a 12:00','de 13:00 a 14:00', 'de 14:00 a 15:00',
                                    'de 15:00 a 16:00', 'de 16:00 a 17:00']);*/
            $table->string('hora_inicio');
            $table->string('hora_fin');
            
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
        Schema::dropIfExists('horarios');
    }
}
