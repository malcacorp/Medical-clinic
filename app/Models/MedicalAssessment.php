<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAssessment extends Model
{
    use HasFactory;

    /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'employee_id',
    'nurse_id',
    'height',
    'weight',
    'temperature',
    'blood_pressure',
    'medical_condition',
    'medical_history',
    'alergic',
    'alergies',
    'medical_concerns',
    'diagnostic',
    'treatment',
    'active'
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
