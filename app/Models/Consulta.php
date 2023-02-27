<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_cita",
        "motivo",
        "EA",
        "condiciones",
        "peso",
        "talla",
        "imc",
        "TA",
        "FC",
        "FR"
      ];
      
    public function citas(){
        return $this->belongsTo('App\Models\Cita');
    }

}
