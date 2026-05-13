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
            $table->string('birth_place')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
        });

        Schema::table('medical_assessments', function (Blueprint $table) {
            $table->integer('maternal_age')->nullable();
            $table->integer('gestas_ped')->nullable();
            $table->integer('paras')->nullable();
            $table->integer('abortos_ped')->nullable();
            $table->boolean('controlled_pregnancy')->nullable();
            $table->integer('consultations_count')->nullable();
            $table->text('pregnancy_complications')->nullable();
            $table->text('serology')->nullable();
            $table->string('mother_blood_type')->nullable();
            $table->string('father_blood_type')->nullable();
            $table->text('urinalysis')->nullable();
            $table->string('delivery_method')->nullable();
            $table->integer('gestational_weeks')->nullable();
            $table->text('cesarean_indication')->nullable();
            $table->integer('apgar_1')->nullable();
            $table->integer('apgar_5')->nullable();
            $table->text('amniotic_liquid')->nullable();
            $table->text('other_complications')->nullable();
            $table->float('pan')->nullable();
            $table->float('tan')->nullable();
            $table->float('cc_neonatal')->nullable();
            $table->float('ct_neonatal')->nullable();
            $table->float('ca_neonatal')->nullable();
            $table->boolean('breathed_cried')->nullable();
            $table->boolean('hospitalized_at_birth')->nullable();
            $table->integer('gestational_age_weeks')->nullable();
            $table->string('method_capurro_ballard')->nullable();
            $table->text('neonatal_observations')->nullable();
            $table->integer('lme_months')->nullable();
            $table->integer('formula_months')->nullable();
            $table->text('formula_indication')->nullable();
            $table->integer('ablactation_months')->nullable();
            $table->boolean('family_diet_incorporation')->nullable();
            $table->text('milestones')->nullable();
            $table->text('habits_ped')->nullable();
            $table->text('physical_exam_ped')->nullable();
            $table->text('percentiles')->nullable();
            $table->text('vaccines')->nullable();
            $table->text('family_history_ped')->nullable();
            $table->text('plan_ped')->nullable();
            $table->text('objective_ped')->nullable();
            $table->text('subjective_ped')->nullable();
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
            $table->dropColumn(['birth_place', 'blood_group', 'mother_name', 'father_name']);
        });

        Schema::table('medical_assessments', function (Blueprint $table) {
            $table->dropColumn([
                'maternal_age', 'gestas_ped', 'paras', 'abortos_ped', 'controlled_pregnancy',
                'consultations_count', 'pregnancy_complications', 'serology', 'mother_blood_type',
                'father_blood_type', 'urinalysis', 'delivery_method', 'gestational_weeks',
                'cesarean_indication', 'apgar_1', 'apgar_5', 'amniotic_liquid', 'other_complications',
                'pan', 'tan', 'cc_neonatal', 'ct_neonatal', 'ca_neonatal', 'breathed_cried',
                'hospitalized_at_birth', 'gestational_age_weeks', 'method_capurro_ballard',
                'neonatal_observations', 'lme_months', 'formula_months', 'formula_indication',
                'ablactation_months', 'family_diet_incorporation', 'milestones', 'habits_ped',
                'physical_exam_ped', 'percentiles', 'vaccines', 'family_history_ped',
                'plan_ped', 'objective_ped', 'subjective_ped'
            ]);
        });
    }
};
