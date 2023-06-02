<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
  public $totalPatients = 0, $appointments = [], $totalAppointments = 0;
  public $patient;
  public function render()
  {
    if (!auth()->user()->roles->contains('name', 'patient')) {
      $today = date('Y-m-d');
      $this->totalPatients = Patient::count();
      $this->appointments = Appointment::where("date", $today)->get();
      $this->totalAppointments = $this->appointments->count();
    } else {
      $this->patient = Patient::where('user_id', Auth::user()->id)
                              ->with([
                                'appointments' => function ($query) {
                                  $query->where('status', "Pending");
                                }
                              ])
                              ->first();
    }

    return view('livewire.dashboard.dashboard');
  }
}