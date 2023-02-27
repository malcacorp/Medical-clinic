<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona_prueba extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_persona',
        'id_prueba',
        'fecha',
        'comentario',
      ];
}
