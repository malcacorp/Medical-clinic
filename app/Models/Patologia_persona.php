<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patologia_persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_persona',
        'id_patologia',
        'fecha_ini',
        'fecha_fin',
        'ocurrencia',
        'comentario',
        'desenlace'
      ];
}
