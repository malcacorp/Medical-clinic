<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habito extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_persona",
        "tbq_bool",
        "tbq_det",
        "alc_bool",
        "alc_det",
        "drg_bool",
        "drg_det",
        "sex",
        "nut"
      ];
}
