<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inmunizacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre'
    ];
}
