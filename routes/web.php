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

Route::get('/', [App\Http\Controllers\pagesController::class, 'home'])->name('home');

Auth::routes();
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');


Route::get('/home', [App\Http\Controllers\pagesController::class, 'home'])->name('home');


Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'inicio'])->name('inicio');
Route::get('/registrar', [App\Http\Controllers\PersonasController::class, 'registrar'])->name('registrar');
Route::get('/pacientes', [App\Http\Controllers\PacientesController::class, 'index'])->name('pacientes');
Route::get('/pacientes/registrar', [App\Http\Controllers\PacientesController::class, 'add'])->name('anadir-paciente');
Route::post('/pacientes/registrar', [App\Http\Controllers\PacientesController::class, 'store'])->name('paciente.store');


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
Route::get('/citas', [App\Http\Controllers\CitasController::class, 'index'])->name('citas');
Route::get('/citas/crear/{id?}', [App\Http\Controllers\CitasController::class, 'add'])->name('cita.add');
Route::post('/citas/crear', [App\Http\Controllers\CitasController::class, 'save'])->name('cita.save');
Route::delete('/citas/borrar', [App\Http\Controllers\CitasController::class, 'delete'])->name('cita.delete');
Route::get('/citas/edit/{id}', [App\Http\Controllers\CitasController::class, 'edit'])->name('cita.edit');
Route::put('/citas/edit/{id}', [App\Http\Controllers\CitasController::class, 'update'])->name('cita.update');
Route::get('/consultas/{id}', [App\Http\Controllers\CitasController::class, 'consulta'])->name('consultas');
Route::post('/consultas/{id}', [App\Http\Controllers\CitasController::class, 'consultaAdd'])->name('consulta.add');


//CRUD PACIENTES
Route::get('/pacientes', [App\Http\Controllers\PacientesController::class, 'index'])->name('pacientes');
Route::get('/pacientes/registrar', [App\Http\Controllers\PacientesController::class, 'add'])->name('anadir-paciente');
Route::post('/pacientes/registrar', [App\Http\Controllers\PacientesController::class, 'store'])->name('paciente.store');
Route::get('/pacientes/editar/{id}', [App\Http\Controllers\PacientesController::class, 'edit'])->name('paciente.editar');
Route::put('/pacientes/editar/{id}', [App\Http\Controllers\PacientesController::class, 'update'])->name('paciente.update');
Route::delete('/pacientes/borrar', [App\Http\Controllers\PacientesController::class, 'delete'])->name('paciente.delete');

Route::get('/pacientes/detalles/{id}', [App\Http\Controllers\PacientesController::class, 'details'])->name('paciente.detalles');

Route::get('/pacientes/historia/patologias/{id}', [App\Http\Controllers\PacientesController::class, 'patologia'])->name('paciente.patologia');
Route::post('/pacientes/historia/patologias', [App\Http\Controllers\PacientesController::class, 'patologiaStore'])->name('paciente.patologia.store');
Route::get('/pacientes/historia/medicamentos/{id}', [App\Http\Controllers\PacientesController::class, 'medicamento'])->name('paciente.medicamento');
Route::post('/pacientes/historia/medicamentos', [App\Http\Controllers\PacientesController::class, 'medicamentoStore'])->name('paciente.medicamento.store');
Route::get('/pacientes/historia/alergias/{id}', [App\Http\Controllers\PacientesController::class, 'alergia'])->name('paciente.alergia');
Route::post('/pacientes/historia/alergias', [App\Http\Controllers\PacientesController::class, 'alergiaStore'])->name('paciente.alergia.store');

Route::get('/pacientes/historia/pruebas/{id}', [App\Http\Controllers\PacientesController::class, 'prueba'])->name('paciente.prueba');
Route::post('/pacientes/historia/pruebas', [App\Http\Controllers\PacientesController::class, 'pruebaStore'])->name('paciente.prueba.store');
Route::get('/pacientes/historia/inmunizaciones/{id}', [App\Http\Controllers\PacientesController::class, 'inmunizacion'])->name('paciente.inmunizacion');
Route::post('/pacientes/historia/inmunizaciones', [App\Http\Controllers\PacientesController::class, 'inmunizacionStore'])->name('paciente.inmunizacion.store');


//CRUD DOCTORES 
Route::get('/doctores', [App\Http\Controllers\DoctoresController::class, 'index'])->name('doctores');
Route::get('/doctores/registrar', [App\Http\Controllers\DoctoresController::class, 'add'])->name('medico.add');
Route::post('/doctores/registrar', [App\Http\Controllers\DoctoresController::class, 'save'])->name('medico.save');

//crud horarios
Route::get('/horarios', [App\Http\Controllers\HorariosController::class, 'index'])->name('horarios');
Route::get('/horarios/registrar', [App\Http\Controllers\HorariosController::class, 'add'])->name('horarios.add');
Route::post('/horarios/registrar', [App\Http\Controllers\HorariosController::class, 'save'])->name('horarios.save');

//ajustes
Route::get('/ajustes', [App\Http\Controllers\AjustesController::class, 'index'])->name('ajustes');
Route::get('/ajustes/patologias', [App\Http\Controllers\AjustesController::class, 'patologiaAdd'])->name('patologia.add');
Route::post('/ajustes/patologias', [App\Http\Controllers\AjustesController::class, 'patologiaSave'])->name('patologia.save');
Route::get('/ajustes/patologias/{id}', [App\Http\Controllers\AjustesController::class, 'patologiaEditar'])->name('patologia.editar');
Route::put('/ajustes/patologias/{id}', [App\Http\Controllers\AjustesController::class, 'patologiaUpdate'])->name('patologia.update');
Route::get('/ajustes/medicamentos', [App\Http\Controllers\AjustesController::class, 'medicamentoAdd'])->name('medicamento.add');
Route::post('/ajustes/medicamentos', [App\Http\Controllers\AjustesController::class, 'medicamentoSave'])->name('medicamento.save');
Route::get('/ajustes/medicamentos/{id}', [App\Http\Controllers\AjustesController::class, 'medicamentoEditar'])->name('medicamento.editar');
Route::put('/ajustes/medicamentos/{id}', [App\Http\Controllers\AjustesController::class, 'medicamentoUpdate'])->name('medicamento.update');
Route::get('/ajustes/alergias', [App\Http\Controllers\AjustesController::class, 'alergiaAdd'])->name('alergia.add');
Route::post('/ajustes/alergias', [App\Http\Controllers\AjustesController::class, 'alergiaSave'])->name('alergia.save');
Route::get('/ajustes/alergias/{id}', [App\Http\Controllers\AjustesController::class, 'alergiaEditar'])->name('alergia.editar');
Route::put('/ajustes/alergias/{id}', [App\Http\Controllers\AjustesController::class, 'alergiaUpdate'])->name('alergia.update');
Route::get('/ajustes/pruebas', [App\Http\Controllers\AjustesController::class, 'pruebaAdd'])->name('prueba.add');
Route::post('/ajustes/pruebas', [App\Http\Controllers\AjustesController::class, 'pruebaSave'])->name('prueba.save');
Route::get('/ajustes/pruebas/{id}', [App\Http\Controllers\AjustesController::class, 'pruebaEditar'])->name('prueba.editar');
Route::put('/ajustes/pruebas/{id}', [App\Http\Controllers\AjustesController::class, 'pruebaUpdate'])->name('prueba.update');
Route::get('/ajustes/inmunizaciones', [App\Http\Controllers\AjustesController::class, 'inmunizacionAdd'])->name('inmunizacion.add');
Route::post('/ajustes/inmunizaciones', [App\Http\Controllers\AjustesController::class, 'inmunizacionSave'])->name('inmunizacion.save');
Route::get('/ajustes/inmunizaciones/{id}', [App\Http\Controllers\AjustesController::class, 'inmunizacionEditar'])->name('inmunizacion.editar');
Route::put('/ajustes/inmunizaciones/{id}', [App\Http\Controllers\AjustesController::class, 'inmunizacionUpdate'])->name('inmunizacion.update');

Route::get('/teleconsulta', [App\Http\Controllers\TeleconsultaController::class, 'index'])->name('teleconsulta');


Route::put('/paciente/antecedentes/{id}', [App\Http\Controllers\PacientesController::class, 'antecedentesUpdate'])->name('antecedentes.update');

