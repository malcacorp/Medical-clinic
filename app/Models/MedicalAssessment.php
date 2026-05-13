<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAssessment extends Model
{
    use HasFactory;
    protected $connection = "mysql";

    /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'employee_id',
    'nurse_id',
    'height',
    'weight',
    'temperature',
    'previous_illnesses',
    'blood_pressure',
    'medical_condition',
    'medical_history', 
    'alergic',
    'alergies',
    'medical_concerns',
    'diagnostic',
    'treatment',
    'active',
    'fur',
    'menarquia',
    'cycles',
    'sexual_activity',
    'coitarche',
    'partners',
    'contraceptive',
    'papanicolaou',
    'mammography',
    'gestas',
    'partos',
    'cesareas',
    'abortos',
    'ectopicos',
    'last_delivery',
    'obstetric_complications',
    'family_history',
    'habits',
    'physical_exam_gyneco',
    'current_illness',
    'requested_exams',
    'management_plan',
    'maternal_age',
    'gestas_ped',
    'paras',
    'abortos_ped',
    'controlled_pregnancy',
    'consultations_count',
    'pregnancy_complications',
    'serology',
    'mother_blood_type',
    'father_blood_type',
    'urinalysis',
    'delivery_method',
    'gestational_weeks',
    'cesarean_indication',
    'apgar_1',
    'apgar_5',
    'amniotic_liquid',
    'other_complications',
    'pan',
    'tan',
    'cc_neonatal',
    'ct_neonatal',
    'ca_neonatal',
    'breathed_cried',
    'hospitalized_at_birth',
    'gestational_age_weeks',
    'method_capurro_ballard',
    'neonatal_observations',
    'lme_months',
    'formula_months',
    'formula_indication',
    'ablactation_months',
    'family_diet_incorporation',
    'milestones',
    'habits_ped',
    'physical_exam_ped',
    'percentiles',
    'vaccines',
    'family_history_ped',
    'plan_ped',
    'objective_ped',
    'subjective_ped',
  ];

  public function patient()
  {
    return $this->belongsTo('App\Models\Patient');;
  }

  public function employee()
  {
    return $this->belongsTo('App\Models\Employee');
  }


}
