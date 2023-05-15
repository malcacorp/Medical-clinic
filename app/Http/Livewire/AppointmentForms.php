<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Employee;
use Illuminate\Http\Request;

class AppointmentForms extends Component
{
  public $doctors = [];
  public $doctorSelected;
  public $patients, $last_name, $first_name, $medical_concerns;
  public $appointments, $appointment_id, $name;
  public $appointment, $appointmentPermissions;
  public $isEmployee;
  public $date;
  public $time;
  public $doctor_id;


  public function mount($id = null, $status, $toShow = null, $toAss = null)
  {
      if ($id != null) {
          $this->appointment = Appointment::findOrFail(intval($id));
          $this->doctors = Employee::all();
          $this->date = $this->appointment->date;
          $this->time = $this->appointment->time;
          $this->doctor_id = $this->appointment->doctor_id;
          $this->medical_concerns = $this->appointment->medical_concerns;
      }
  }

  public function store()
  {
      $this->validate([
          'date' => 'required|date',
          'time' => 'required',
          'doctor_id' => 'required',
          'medical_concerns' => 'required',
      ]);

      if ($this->appointment) {
          $this->appointment->update([
              'date' => $this->date,
              'time' => $this->time,
              'doctor_id' => $this->doctor_id,
              'medical_concerns' => $this->medical_concerns,
          ]);
      } else {
          Appointment::create([
              'date' => $this->date,
              'time' => $this->time,
              'doctor_id' => $this->doctor_id,
              'medical_concerns' => $this->medical_concerns,
          ]);
      }

      session()->flash('success', 'Appointment ' . ($this->appointment ? 'updated' : 'created') . ' successfully.');

      return redirect()->route('appointments');
  }

  public function render()
  {
    return view('livewire.appointment.appointment');
  }
}
