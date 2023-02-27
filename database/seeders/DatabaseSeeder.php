<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        App\Models\Pais::create([

            'nombre' => 'Venezuela',
         
        ]);
        App\Models\Pais::create([

            'nombre' => 'Colombia',
         
        ]);
        App\Models\Pais::create([

            'nombre' => 'Peru',
         
        ]);
        App\Models\Pais::create([

            'nombre' => 'Chile',
         
        ]);
        App\Models\Etnia::create([

            'nombre' => 'Asiatico',
         
        ]);App\Models\Etnia::create([

            'nombre' => 'Indio',
         
        ]);App\Models\Etnia::create([

            'nombre' => 'Latino',
         
        ]);
        App\Models\Religion::create([

            'nombre' => 'Cristianismo',
         
        ]);
        App\Models\Religion::create([

            'nombre' => 'Islamismo',
         
        ]);
        App\Models\Religion::create([

            'nombre' => 'Budismo',
         
        ]);
        App\Models\Religion::create([

            'nombre' => 'Ateo',
         
        ]);
        App\Models\GrupoSanguineo::create([

            'nombre' => 'a+',
         
        ]);
        App\Models\GrupoSanguineo::create([

            'nombre' => 'ab',
         
        ]);
        App\Models\GrupoSanguineo::create([

            'nombre' => 'o-',
         
        ]);
        App\Models\Estado::create([

            'nombre' => 'California',
         
        ]);
        App\Models\Estado::create([

            'nombre' => 'Carabobo',
         
        ]);
        App\Models\Estado::create([

            'nombre' => 'Aragua',
         
        ]);
        App\Models\Colegio::create([

            'nombre' => 'Harvard',
         
        ]);
        App\Models\Colegio::create([

            'nombre' => 'MIT',
         
        ]);
        App\Models\Colegio::create([

            'nombre' => 'UCV',
         
        ]);
        App\Models\EstadoCivil::create([

            'nombre' => 'Casado',
         
        ]);
        App\Models\EstadoCivil::create([

            'nombre' => 'Viudo',
         
        ]);
        App\Models\EstadoCivil::create([

            'nombre' => 'Soltero',
         
        ]);
        App\Models\Patologia::create([

            'nombre' => 'Cancer',
         
        ]);
        App\Models\Patologia::create([

            'nombre' => 'Tuberculosis',
         
        ]);App\Models\Patologia::create([

            'nombre' => 'Artritis',
         
        ]);
        App\Models\Patologia::create([

            'nombre' => 'Rinitis',
         
        ]);
        App\Models\Prueba::create([

            'nombre' => 'Mamografia',
         
        ]);
        App\Models\Prueba::create([

            'nombre' => 'Hematologia',
         
        ]);
        App\Models\Prueba::create([

            'nombre' => 'Cultivo de esputo',
         
        ]);
        App\Models\Medicamento::create([

            'nombre' => 'Acetominofen',
         
        ]);
        App\Models\Medicamento::create([

            'nombre' => 'Amoxicilina',
         
        ]);
        App\Models\Medicamento::create([

            'nombre' => 'Aspirina',
         
        ]);
        App\Models\Alergia::create([

            'nombre' => 'Penicilina',
         
        ]);
        App\Models\Alergia::create([

            'nombre' => 'Amoxicilina',
         
        ]);
        App\Models\Alergia::create([

            'nombre' => 'Epinefrina',
         
        ]);
        App\Models\Inmunizacion::create([

            'nombre' => 'Influenza Estacional',
         
        ]);
        App\Models\Inmunizacion::create([

            'nombre' => 'Antiamarílica',
         
        ]);
        App\Models\Inmunizacion::create([

            'nombre' => 'Pentavalente',
         
        ]);
        App\Models\Inmunizacion::create([

            'nombre' => 'Polio',
         
        ]);

  
        App\Models\Persona::create([

            'nombres' => 'Joshua moises',
            'apellido_materno' => 'Serrano',
            'apellido_paterno' => 'Hernandez',
            'rol' => 'PACIENTE',
            'login' => 'Joshie',
            'dni' => '24347135',
            'email' => 'joshuamoises1995@gmail.com',
            'password' => Hash::make('0000'),
            'id_sexo' => '1',
            'direccion' => 'Barrio Vista Alegre',
            'id_pais' => '4',
            'ciudad' => 'Maracay',
            'id_estado' => '2',
            'telefono' => '04122589635',
            'ruta_foto' => '1606866248.jpeg',
            'id_religion' => '1'
         
        ]);

        App\Models\User::create([

            'id_persona' => 1,
            'email' => 'joshuamoises1995@gmail.com',
            'name' => 'Joshua moises hernandez',
            'password' => Hash::make('0000'),

            
        ]);
    }
}
