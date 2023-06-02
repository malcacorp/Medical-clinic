<?php

use App\Http\Livewire\AppointmentForms;
use App\Http\Livewire\Appointments;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Patients;
use App\Http\Livewire\Intake;
use App\Http\Livewire\Users;
use App\Http\Livewire\Employees;
use App\Http\Livewire\MySchedule;
use App\Http\Livewire\Patients2\Index;
use App\Http\Livewire\Permissions;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Schedule;

use App\Http\Livewire\Patients2\PatientsForms;


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

/* // Sql Debuger
DB::listen(function($query){
  //Imprimimos la consulta ejecutada
  echo "<pre> {$query->sql } </pre>";
}); */

Route::get('/', function () {
    return view('auth.login');
});

Route::get('intake', Intake::class)->name('intake');

Route::get('/locale/{locale}', function ($locale) {
    return redirect()->back()->withCookie('locale', $locale);
})->name('locale');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});

Route::group(['middleware' => ['permission:list-employees']], function () {
    Route::get('employees', Employees::class)->name('employees');
});

Route::group(['middleware' => ['permission:list-patients']], function () {
    Route::get('patients', Patients::class)->name('patients');
});

Route::group(['middleware' => ['permission:list-patients']], function () {
    Route::get('patients2', Index::class)->name('patients2');
    Route::get('/patients2/create', PatientsForms::class)->name('patients-create');
    Route::get('/patients2/{id}', PatientsForms::class)->name('patient-edit');
    Route::get('/patients2/{id}/{toShow}', PatientsForms::class)->name('patient-histories');
});

Route::group(['middleware' => ['permission:list-permissions']], function () {
    Route::get('permissions', Permissions::class)->name('permissions');
});

Route::group(['middleware' => ['permission:list-roles']], function () {
    Route::get('roles', Roles::class)->name('roles');
});

Route::group(['middleware' => ['permission:list-appointments']], function () {
    Route::get('appointments', Appointments::class)->name('appointments');
    // Route::get('appointments', AppointmentForms::class)->name('appointments');
    Route::get('appointment/create', AppointmentForms::class)->name('appointment.create');
    Route::get('appointment/{id}', AppointmentForms::class)->name('appointment');
});

Route::group(['middleware' => ['permission:list-users']], function () {
    Route::get('users', Users::class)->name('users');
});

Route::group(['middleware' => ['permission:view-schedule']], function () {
    Route::get('schedule', Schedule::class)->name('schedule');
});

Route::group(['middleware' => ['permission:view-staff-schedule']], function () {
    Route::get('schedule/{id}', Schedule::class)->name('staff-schedule');
});

Route::group(['middleware' => ['permission:view-myschedule']], function () {
    Route::get('my-schedule', MySchedule::class)->name('my-schedule');
});