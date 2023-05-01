<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
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
    'profession',
    'position',
    'speciality',
    'email',
    'phone_number',
    'birthdate',
    'address',
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function medical_assessment()
  {
    return $this->hasMany('App\Models\MedicalAssessment');
  }

  public function events()
  {
      return $this->hasMany('App\Models\Event');
  }

  public function appointments()
  {
      return $this->hasMany('App\Models\Appointment');
  }
}