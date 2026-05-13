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
        Schema::table('patients', function (Blueprint $table) {
            $table->string('marital_status')->nullable();
            $table->string('occupation')->nullable();
        });

        Schema::table('medical_assessments', function (Blueprint $table) {
            $table->date('fur')->nullable();
            $table->string('menarquia')->nullable();
            $table->string('cycles')->nullable();
            $table->boolean('sexual_activity')->nullable();
            $table->string('coitarche')->nullable();
            $table->integer('partners')->nullable();
            $table->string('contraceptive')->nullable();
            $table->date('papanicolaou')->nullable();
            $table->date('mammography')->nullable();
            $table->integer('gestas')->nullable();
            $table->integer('partos')->nullable();
            $table->integer('cesareas')->nullable();
            $table->integer('abortos')->nullable();
            $table->integer('ectopicos')->nullable();
            $table->date('last_delivery')->nullable();
            $table->text('obstetric_complications')->nullable();
            $table->text('family_history')->nullable();
            $table->text('habits')->nullable();
            $table->text('physical_exam_gyneco')->nullable();
            $table->text('current_illness')->nullable();
            $table->text('requested_exams')->nullable();
            $table->text('management_plan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['marital_status', 'occupation']);
        });

        Schema::table('medical_assessments', function (Blueprint $table) {
            $table->dropColumn([
                'fur', 'menarquia', 'cycles', 'sexual_activity', 'coitarche', 'partners',
                'contraceptive', 'papanicolaou', 'mammography', 'gestas', 'partos',
                'cesareas', 'abortos', 'ectopicos', 'last_delivery', 'obstetric_complications',
                'family_history', 'habits', 'physical_exam_gyneco', 'current_illness',
                'requested_exams', 'management_plan'
            ]);
        });
    }
};
