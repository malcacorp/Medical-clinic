<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre'
      ];

    public function persona(){
        return $this->belongsToMany('App\Models\Persona');
    }
}
