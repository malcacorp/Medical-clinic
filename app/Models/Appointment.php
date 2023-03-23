<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'assessment_type',
    'date',
    'time',
    'medical_concerns',
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function employee()
  {
    return $this->belongsTo('App\Models\Employee');
  }

  public function patient()
  {
    return $this->belongsTo('App\Models\Patient');
  }
}