<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UpdateDoctorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Encontrar a Freddy y desactivarlo (cambiar su posición) en lugar de eliminarlo para no romper el historial de citas.
        $freddy = Employee::where('first_name', 'like', '%Freddy%')->orWhere('id', 2)->first();
        if ($freddy) {
            // Cambiamos su posición para que no aparezca en la lista de doctores activos
            $freddy->update(['position' => 'INACTIVE']);
        }

        // 2. Agregar a Hecnys Vanesa Muñoz Roca en ginecologia
        $user1 = User::create([
            'name' => 'Hecnys Vanesa Muñoz Roca',
            'email' => 'hecnys.munoz@esperanzaclinic.com',
            'password' => Hash::make('password123'),
        ]);

        Employee::create([
            'user_id' => $user1->id,
            'id_number' => '1000000001',
            'first_name' => 'Hecnys Vanesa',
            'last_name' => 'Muñoz Roca',
            'sex' => 'Femenino',
            'profession' => 'Medico',
            'position' => 'DOCTOR',
            'speciality' => 'Ginecología',
            'email' => 'hecnys.munoz@esperanzaclinic.com',
            'phone_number' => '0000000000',
            'birthdate' => '1990-01-01',
            'address' => 'N/A',
        ]);

        // 3. Agregar a Carlo Belli en pediatria
        $user2 = User::create([
            'name' => 'Carlo Belli',
            'email' => 'carlo.belli@esperanzaclinic.com',
            'password' => Hash::make('password123'),
        ]);

        Employee::create([
            'user_id' => $user2->id,
            'id_number' => '1000000002',
            'first_name' => 'Carlo',
            'last_name' => 'Belli',
            'sex' => 'Masculino',
            'profession' => 'Medico',
            'position' => 'DOCTOR',
            'speciality' => 'Pediatría',
            'email' => 'carlo.belli@esperanzaclinic.com',
            'phone_number' => '0000000000',
            'birthdate' => '1990-01-01',
            'address' => 'N/A',
        ]);

        $this->command->info('Doctor Freddy eliminado y nuevos doctores agregados con exito!');
    }
}
