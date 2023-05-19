<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Patient;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalPatients = 0, $appointments = [], $totalAppointments = 0;
    public function render()
    {
        $today = date('Y-m-d');
        $this->totalPatients = Patient::all()->count();
        $this->appointments = Appointment::leftJoin("patients AS p", "appointments.patient_id", "p.id")
                                          ->leftJoin("employees AS em", "appointments.employee_id", "em.id")
                                          ->select("appointments.*", "p.phone_number")
                                          ->selectRaw("CONCAT(p.first_name, ' ', p.last_name) AS patientName")
                                          ->selectRaw("CONCAT(em.first_name, ' ', em.last_name) AS doctorName")
                                          ->where("date", $today)
                                          ->get();
        // dd($this->appointments);
        $this->totalAppointments = $this->appointments->count();
        return view('livewire.dashboard.dashboard');
    }
}
