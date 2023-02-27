<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicamento_persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_persona',
        'id_medicamento',
        'fecha_ini',
        'fecha_fin',
        'ocurrencia',
        'comentario',
        'desenlace'
      ];
}
