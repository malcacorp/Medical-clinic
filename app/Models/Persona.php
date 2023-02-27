<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;


    protected $fillable = [
        'nombres',
        'apellido_materno',
        'apellido_paterno',
        'login',
        'dni',
        'password',
        'rol',
        'email',
        'fecha_nac',
        'id_sexo',
        'direccion_nac',
        'id_pais_nac',
        'ciudad_nac',
        'id_estado_nac',
        'zip_nac',
        'direccion',
        'id_pais',
        'ciudad',
        'id_estado',
        'zip',
        'telefono',
        'ruta_foto',
        'ruta_doc_identidad',
        'grado_instruccion',
        'id_colegio_prof',
        'num_colegiatura',
        'es_empleado_ins',
        'id_grupo_sanguineo',
        'donacion_organos',
        'ORCID',
        'id_estado_civil',
        'id_etnias',
        'id_religion',
        'status',
        'id_colegio',
      ];

      public function patologias(){
        return $this->hasMany('App\Models\Patologia');
      }
  
      public function pruebas(){
        return $this->hasMany('App\Models\Prueba');
      }

      public function alergias(){
        return $this->hasMany('App\Models\Alergia');
      }

      public function medicamentos(){
        return $this->hasMany('App\Models\medicamento');
      }

      public function consultas(){
        return $this->hasMany('App\Models\Consulta');
      }

      public function antecedentesFamiliares(){
        return $this->hasOne('App\Models\AntecedentesFamiliares');
      }

      public function habitos(){
        return $this->hasOne('App\Models\Habito');
      }

      public function user(){
          return $this->hasOne('App\Models\User');
      }

 
}
