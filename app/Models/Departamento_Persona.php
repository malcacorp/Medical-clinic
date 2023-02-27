<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento_Persona extends Model
{
    use HasFactory;

 
      public function departamento(){
        return $this->belongsTo('App\Models\Departamento','id_departamento');
      }
}
