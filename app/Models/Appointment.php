<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
  use HasFactory;
  protected $connection = "mysql";

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'employee_id',
    'assessment_type',
    'date',
    'time',
    'medical_concerns',
    'status',
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
  public function event()
  {
    return $this->belongsTo('App\Models\Event');
  }
}