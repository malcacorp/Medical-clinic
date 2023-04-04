<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Patients;
use App\Http\Livewire\Intake;
use App\Http\Livewire\Users;
use App\Http\Livewire\Employees;

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
// DB::listen(function($query){
//   //Imprimimos la consulta ejecutada
//   echo "<pre> {$query->sql } </pre>";
// });

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

    // Route::resource('patients', \App\Http\Controllers\PatientController::class);
    Route::get('patients', Patients::class)->name('patients');
    Route::get('employees', Employees::class)->name('employees');

});
