<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $fillable = [
        'paciente_id',
        'departamento_id',
        'consulta_id',
        'doctor_id',
        'fecha',
        'hora',
        'notas',
        'estado'
      ];

    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
    public function consultas(){
        return $this->hasOne('App\Models\Consulta');
    }

}
