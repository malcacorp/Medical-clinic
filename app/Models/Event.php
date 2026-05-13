<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

     /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'start',
  ];

  public function employee()
  {
      return $this->belongsTo('App\Models\Employee');
  }
  public function appointment()
  {
      return $this->hasOne('App\Models\Appointment');
  }
}
