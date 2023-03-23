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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->string('first_name',128)->nullable();
            $table->string('last_name',128)->nullable();
            $table->string('profession')->nullable();
            $table->string('position')->nullable();
            $table->string('speciality')->nullable();
            $table->enum('sex',['Male','Female'])->nullable();
            $table->string('email',128)->nullable();
            $table->string('phone_number')->nullable();
            $table->date('birthdate')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
