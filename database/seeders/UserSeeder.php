<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roleAdmin = Role::create(['name' => 'admin']);
      $roleGuest = Role::create(['name' => 'guest']);

      $adminPermission = Permission::all();
      $roleAdmin->syncPermissions($adminPermission);

      $user = User::factory()->create([
        'name' => 'Steven Malca',
        'email' => 'steven@malcacorp.com',
        'password' => Hash::make('12345678'),
      ]);
      $user->assignRole($roleAdmin);
      
      $user = User::factory()->create([
        'name' => 'Yudith Serrano',
        'email' => 'ycsa91@gmail.com',
        'password' => Hash::make('12345678'),
      ]);
      $user->assignRole($roleAdmin);
      
      $user = User::factory()->create([
        'name' => 'Guest',
        'email' => 'guest@gmail.com',
        'password' => Hash::make('12345678'),
      ]);
      $user->assignRole($roleGuest);

      User::factory(10)->create();
        
    }
}
