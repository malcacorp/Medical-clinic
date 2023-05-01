<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id_number',
    'first_name',
    'last_name',
    'sex',
    'email',
    'phone_number',
    'birthdate',
    'height',
    'weight',
    'eye_color',
    'address',
    'medical_condition',
    'patient_file_path',
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function medicalAssessment()
  {
    return $this->hasMany('App\Models\MedicalAssessment');
  }

  public function appointments()
  {
    return $this->hasMany('App\Models\Appointment');
  }
}