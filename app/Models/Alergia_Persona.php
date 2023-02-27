<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergia_Persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_persona',
        'id_alergia',
        'fecha_ini',
        'fecha_fin',
        'ocurrencia',
        'comentario',
        'desenlace'
      ];
      public function persona(){
        return $this->belongsTo('App\Models\Persona','id_persona');
    }
}
