<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $connection = "mysql";
    /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'day',
    'start',
    'end',
  ];

  public function employee()
  {
      return $this->belongsTo('App\Models\Employee');
  }
}
