<?php

namespace App\Http\Livewire;

use App\Models\Appointment;

use App\Models\Event;
use Illuminate\Validation\Rule;


use Livewire\Component;

class Appointments extends Component
{

  public $appointments, $appointment_id, $name;
  public $appointment, $appointmentPermissions;
  public $isOpenUpdate = 0, $isOpenShow = 0, $isOpenList = 1;


  public function render()
  {
    $this->appointments = Appointment::leftJoin('patients AS p', 'appointments.patient_id', '=', 'p.id')
                                      ->leftJoin('employees AS e', 'appointments.employee_id', '=', 'e.id')
                                      ->where('status', '=', 'Pending')
                                      ->select('appointments.*', 'p.*', 'e.*', 'appointments.id AS appointment_id')
                                      ->selectRaw("CONCAT(e.first_name, ' ', e.last_name) AS doctor_name")
                                      ->selectRaw("CONCAT(p.first_name, ' ', p.last_name) AS patient_name")
                                      ->get();
    // dd($this->appointments);
    return view('livewire.appointment.index');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public function create()
  {
    return redirect()->route('appointment.create');
  }

  
    public function show($id)
  {

    // $appointment = $appointment;
    $appointment = Appointment::findOrFail($id);
    $this->appointment = Appointment::find($id);
    $this->appointmentPermissions = $appointment->permissions;

    $this->appointment_id = $id;
    $this->name = $appointment->name;

    $this->handleTabs('isOpenShow', 'isOpenList');

    // return view('appointments.show', compact('appointment', 'appointmentPermissions'));
  }

  public function handleTabs($toOpen, $toClose, $method = null)
  {
    if ($method != null) {
      if ($this->$method()) {
        $this->$toOpen = true;
        $this->$toClose = false;
        return;
      };
    }

    $this->$toOpen = true;
    $this->$toClose = false;
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  private function resetInputFields()
  {
    $this->appointment_id = '';
    $this->name = '';
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public function store()
  {
    $this->validate([
      'name' => ['required', Rule::unique('appointments')->ignore($this->appointment_id)],
      // 'name' => 'required|unique:appointments,name,'.$this->appointment_id,
    ]);

    $appointment = Appointment::updateOrCreate(['id' => $this->appointment_id], [
      'name' => $this->name,
    ]);


    // $appointment->update($request->only('name'));

    $appointment->syncPermissions($this->appointmentPermissions);

    session()->flash(
      'message',
      $this->appointment_id ? 'Appointment Updated Successfully.' : 'Appointment Created Successfully.'
    );

    $this->handleTabs('isOpenList', 'isOpenUpdate');
    $this->resetInputFields();
  }
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public function edit($id)
  {

    return redirect()->route('appointment', ['id' => $id]);
    /* $appointment = Appointment::findOrFail($id);
    $this->appointment_id = $id;
    $this->name = $appointment->name;

    $this->appointment = Appointment::find($id);
    $this->appointmentPermissions = $appointment->permissions->pluck('name')->toArray();

    $this->handleTabs('isOpenUpdate', 'isOpenList'); */
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public function delete($id)
  {
    $appointment = Appointment::find($id);
    $appointment->status = 'Canceled';
    $appointment->save();

    $event = Event::find($appointment->event_id);

    $event->update([
      'title' => 'Available'
    ]);

    $appointment->event()->dissociate();
    // Guardar los cambios
    $appointment->save();

    session()->flash('message', 'Appointment deleted successfully.');

  }
}
