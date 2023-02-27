<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario_Persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_persona',
        'id_horario',
        'dias'
      ];
}
