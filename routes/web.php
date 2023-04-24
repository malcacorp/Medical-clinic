<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Patients;
use App\Http\Livewire\Intake;
use App\Http\Livewire\Users;
use App\Http\Livewire\Employees;
use App\Http\Livewire\Permissions;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Schedule;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Sql Debuger
DB::listen(function($query){
  //Imprimimos la consulta ejecutada
  echo "<pre> {$query->sql } </pre>";
});

Route::get('/', function () {
  return view('auth.login');
});

Route::get('intake', Intake::class)->name('intake');

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified'
])->group(function () {
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');
});

Route::group(['middleware' => ['permission:list-employees']], function () {
  Route::get('employees', Employees::class)->name('employees');
});

Route::group(['middleware' => ['permission:list-patients']], function () {
  Route::get('patients', Patients::class)->name('patients');
});

Route::group(['middleware' => ['permission:list-permissions']], function () {
  Route::get('permissions', Permissions::class)->name('permissions');
});

Route::group(['middleware' => ['permission:list-roles']], function () {
  Route::get('roles', Roles::class)->name('roles');
});

Route::group(['middleware' => ['permission:list-users']], function () {
  Route::get('users', Users::class)->name('users');
});

Route::group(['middleware' => ['permission:view-schedule']], function () {
  Route::get('schedule', Schedule::class)->name('schedule');
});