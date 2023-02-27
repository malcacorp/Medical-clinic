<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio');
Route::get('/registrar', [App\Http\Controllers\PersonasController::class, 'registrar'])->name('registrar');
Route::get('/pacientes', [App\Http\Controllers\PacientesController::class, 'index'])->name('pacientes');
Route::get('/pacientes/registrar', [App\Http\Controllers\PacientesController::class, 'add'])->name('anadir-paciente');
Route::post('/pacientes/registrar', [App\Http\Controllers\PacientesController::class, 'store'])->name('paciente.store');


Route::get('/doctores', [App\Http\Controllers\DoctoresController::class, 'index'])->name('doctores');

Route::get('/citas', [App\Http\Controllers\CitasController::class, 'index'])->name('citas');
Route::get('/horarios', [App\Http\Controllers\HorariosController::class, 'index'])->name('horarios');

//CRUD DEPARTAMENTOS
Route::get('/departamentos', [App\Http\Controllers\DepartamentosController::class, 'index'])->name('departamento');
Route::get('/departamentos/crear', [App\Http\Controllers\DepartamentosController::class, 'add'])->name('departamento.add');
Route::post('/departamentos/crear', [App\Http\Controllers\DepartamentosController::class, 'save'])->name('departamento.save');
Route::delete('/departamentos/borrar', [App\Http\Controllers\DepartamentosController::class, 'delete'])->name('departamento.delete');
Route::get('/departamentos/edit/{id}', [App\Http\Controllers\DepartamentosController::class, 'edit'])->name('departamento.edit');
Route::put('/departamentos/edit/{id}', [App\Http\Controllers\DepartamentosController::class, 'update'])->name('departamento.update');


//CRUD CITAS
Route::get('/citas', [App\Http\Controllers\citasController::class, 'index'])->name('cita');
Route::get('/citas/crear', [App\Http\Controllers\citasController::class, 'add'])->name('cita.add');
Route::post('/citas/crear', [App\Http\Controllers\citasController::class, 'save'])->name('cita.save');
Route::delete('/citas/borrar', [App\Http\Controllers\citasController::class, 'delete'])->name('cita.delete');
Route::get('/citas/edit/{id}', [App\Http\Controllers\citasController::class, 'edit'])->name('cita.edit');
Route::put('/citas/edit/{id}', [App\Http\Controllers\citasController::class, 'update'])->name('cita.update');
