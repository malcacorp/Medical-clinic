<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Appointment;
use App\Models\Employee;
use Illuminate\Http\Request;

class AppointmentForms extends Component
{
  public $doctors = [];
  public $doctorSelected;
  public $patients, $last_name, $first_name, $medical_concerns, $patient_id;
  public $appointments, $appointment_id, $name, $event;
  public $appointment;
  public $isEmployee;
  public $date;
  public $time;
  public $doctor_id;
  public $isEdit = false;


  public function mount($id = null, $status, $toShow = null, $toAss = null)
  {
    $this->patients = Patient::all();
    $this->doctors = Employee::where('position', 'DOCTOR')->get();
    if ($id != null) {
      $this->appointment = Appointment::findOrFail(intval($id));
      $this->date = $this->appointment->date;
      $this->time = $this->appointment->time;
      $this->doctor_id = $this->appointment->employee_id;
      $this->patient_id = $this->appointment->patient_id;
      $this->medical_concerns = $this->appointment->medical_concerns;

      $this->event = Event::find($this->appointment->event_id);
      $this->isEdit = true;
    }
  }

  public function render()
  {
    return view('livewire.appointment.appointment');
  }

  public function store()
  {
    $this->validate([
      'date' => 'required|date',
      'time' => 'required',
      'doctor_id' => 'required',
      'medical_concerns' => 'required',
    ]);

    $availability = Event::where("title", "=", "Available")
      ->where("start", "LIKE", "%" . $this->date . "T" . $this->time . "%")
      ->where("employee_id", $this->doctor_id)
      ->first();

    if ($availability != null) {
      if ($this->appointment) {
        $this->appointment->update([
          'date' => $this->date,
          'time' => $this->time,
          'doctor_id' => $this->doctor_id,
          'medical_concerns' => $this->medical_concerns,
        ]);

        $this->event->update([
          'start' => $this->date . 'T' . $this->time,
          'title' => 'Appointment'
        ]);

      } else {
        $appointment = Appointment::create([
          'date' => $this->date,
          'time' => $this->time,
          'medical_concerns' => $this->medical_concerns,
          'status' => 'Pending',
        ]);

        $employee = Employee::find(intval($this->doctor_id))->first();
        $patient = Patient::find($this->patient_id);

        $patient->appointments()->save($appointment);
        $employee->appointments()->save($appointment);

        $availability->update([
          'start' => $this->date . 'T' . $this->time,
          'title' => 'Appointment'
        ]);

        $availability->appointment()->save($appointment);

        // $employee->events()->save($availability);

        $this->reset();
      }
      session()->flash('success', 'Appointment ' . ($this->appointment ? 'updated' : 'created') . ' successfully.');

    return redirect()->route('appointments');
    } else {
      session()->flash('message', 'Not availability');
    }
  }

  public function delete()
  {
    // dd($this->appointment->id);
    $appointment = Appointment::find($this->appointment->id);
    $appointment->status = 'Canceled';
    $appointment->save();

    $appointment->event()->update([
      'title' => 'Available'
    ]);

    session()->flash('message', 'Appointment deleted successfully.');
      return redirect()->route('appointments');
  }

}