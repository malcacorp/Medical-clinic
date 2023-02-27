<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedentesFamiliares extends Model
{
    use HasFactory;
    protected $fillable = [
        "id_persona",
        "madre",
        "padre",
        "hermanos",
        "hijos"
      ];

    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }
}
