<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Permission::create(['name' => 'list-roles']);
      Permission::create(['name' => 'create-role']);
      Permission::create(['name' => 'show-role']);
      Permission::create(['name' => 'edit-role']);
      Permission::create(['name' => 'delete-role']);

      Permission::create(['name' => 'list-permissions']);
      Permission::create(['name' => 'create-permission']);
      Permission::create(['name' => 'show-permission']);
      Permission::create(['name' => 'edit-permission']);
      Permission::create(['name' => 'delete-permission']);

      Permission::create(['name' => 'list-users']);
      Permission::create(['name' => 'create-user']);
      Permission::create(['name' => 'show-user']);
      Permission::create(['name' => 'edit-user']);
      Permission::create(['name' => 'delete-user']);

      Permission::create(['name' => 'list-employees']);
      Permission::create(['name' => 'create-employee']);
      Permission::create(['name' => 'show-employee']);
      Permission::create(['name' => 'edit-employee']);
      Permission::create(['name' => 'delete-employee']);

      Permission::create(['name' => 'list-patients']);
      Permission::create(['name' => 'create-patient']);
      Permission::create(['name' => 'show-patient']);
      Permission::create(['name' => 'edit-patient']);
      Permission::create(['name' => 'delete-patient']);

      Permission::create(['name' => 'show-patient-history']);
      Permission::create(['name' => 'create-assessment']);
      Permission::create(['name' => 'edit-nurse-comments']);
      Permission::create(['name' => 'edit-doctor-comments']);

    }
}
