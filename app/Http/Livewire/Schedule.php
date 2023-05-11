<?php
namespace App\Http\Livewire;
use App\Models\Appointment;
use Livewire\Component;
use App\Models\Event;
use App\Models\Employee;
use App\Models\Patient;
 
class Schedule extends Component
{
    public $events = '';
    public $title;
    public $info;
    public $isEmployee;
    public $selectedDate;
    public $doctors = [];
    public $doctorSelected;
    public $currentAppointmentDate = "", $currentAppointmentTime = "", $currentAppointmentPatient = "", $currentAppointmentReason = "", $currentAppointmentPhone = "";
    public $showModal= false;
    // public function mount($title)
    // {
    //     $this->title = $title;

    // }

    protected $listeners = ['closeModal'];
 
    public function getevent()
    {       
        $events = Event::select('id','title','start')->get();
 
        return  json_encode($events);
    }
 
    /**
    * Write code on Method
    *
    * 
    */
    public function addevent($event)
    {
        $user = auth()->user();
        $employee = Employee::where('user_id', $user->id)->first();
        $exists = $employee !== null;
        $role = $user->role;
        //  print($role);
        if ($exists){
          // $input['doctor_id'] = $user->id;
          $input['title'] = $event['title'];
          $input['start'] = $event['start'];
          $event = Event::create($input);

          $employee->events()->save($event);
  
          $this->reset();
  
          $this->emit('eventAdded', $event->id, $event->title, $event->start );
        }else{
          $this->emit('doctorNotExists');
        }
    }
 
    /**
    * Write code on Method
    *
    * 
    */
    public function eventDrop($event, $oldEvent)
    {
      $eventdata = Event::find($event['id']);
      $eventdata->start = $event['start'];
      $eventdata->save();
    }
    public function removeEvent($id){
      Event::find($id)->delete();

      // Emitir una señal de Livewire para actualizar la interfaz de usuario
      $this->emit('refreshCalendar');
    }
    public function addAppointment($appointment)
    {
        $user = auth()->user();
        $employee = Employee::find(intval($appointment['doctorId']))->first();
        $patient = Patient::where("user_id",$user->id)->first();
        $exists = $patient !== null;
        
        if ($exists){
          $availability = Event::where("title", "=", "Available")
                                ->where("start", "LIKE", "%".$appointment['date']."T".$appointment['time']."%")
                                ->where("employee_id", $appointment['doctorId'])
                                ->first();
          
          if($availability != null){            
            $input['medical_concerns'] = $appointment['medical_concerns'];
            $input['date'] = $appointment['date'];
            $input['time'] = $appointment['time'];
            $appointment = Appointment::create($input);
  
            $employee->appointments()->save($appointment);
            $patient->appointments()->save($appointment);
            
            $input['title'] = "Appointment";
            $input['start'] = $appointment['date'].'T'.$appointment['time'];
            $event = Event::create($input);
            $event->appointment()->save($appointment);
            $employee->events()->save($event);
            $this->reset();
            
            $this->emit('eventAdded', $event->id, $event->title, $event->start );
            $this->emit('eventRemoved', $availability->id);
            $availability->delete();
          }else
            $this->emit('notAvailability');
          
        }else
          $this->emit('isNotPatient');
    }

    public function showAppointment($id){
      $currentEvent = Event::find(intval($id));
      $currentEvent = Event::join('appointments', 'appointments.event_id', '=', 'events.id')
                  ->join('patients', 'patients.id', '=', 'appointments.patient_id')
                  ->select('events.id','events.title','appointments.date','appointments.time', 'appointments.medical_concerns', 'patients.first_name', 'patients.last_name', 'patients.phone_number')
                  ->where('events.id', $id)
                  ->orWhere('title', 'Available')
                  ->first();
      // print($currentEvent);
      // $currentDate = explode('T', $currentEvent->start);
      // $this->currentAppointmentDate = {
      //   "date": $currentEvent->date,
      // }
      // $datos = array(
      //     'date' => $currentEvent->date,
      //     'time' => $currentEvent->time,
      //     'patient' => $currentEvent->first_name." ".$currentEvent->last_name
      // );
      // $this->currentAppointment = json_encode($datos);
      $this->currentAppointmentDate = $currentEvent->date;
      $this->currentAppointmentTime = $currentEvent->time;
      $this->currentAppointmentPatient = $currentEvent->first_name." ".$currentEvent->last_name;
      $this->currentAppointmentPhone = $currentEvent->phone_number;
      $this->currentAppointmentReason = $currentEvent->medical_concerns;
    }
 
    /**
    * Write code on Method
    *
    * 
    */
    public function render()
    {
        $user = auth()->user();
        $employee = Employee::where('user_id', $user->id)->first();
        if($employee){
          $availables = Event::select('id','title','start')->where('employee_id', $employee->id)->get();
          $appointments = Event::join('appointments', 'appointments.event_id', '=', 'events.id')
                          ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                          ->select('events.id','start')
                          ->selectRaw("CONCAT(events.title, ' ', patients.first_name, ' ', patients.last_name) AS title")
                          ->where('events.employee_id', $employee->id)->get();
          $events = $availables->merge($appointments);            
          $this->isEmployee = true;
        }
        else{
          $patient = Patient::where("user_id", $user->id)->first();
          if($patient){
            $patientEvents = Event::join('appointments', 'appointments.event_id', '=', 'events.id')
                  ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                  ->select('events.id','events.start')
                  ->selectRaw("CONCAT(events.title, ' ', patients.first_name, ' ', patients.last_name) AS title")
                  ->where('appointments.patient_id', $patient->id)
                  // ->orWhere('title', 'Available')
                  ->get();
            $doctorEvents = Event::select('id','title','start')->where('title', 'Available')->get();
            $events = $patientEvents->merge($doctorEvents);            
          }else{
            $events = Event::select('id','title','start')->where('title', 'Available')->get();
          }

          $doctors = Event::join('employees', 'events.employee_id', '=', 'employees.id')
            ->select('employees.id','employees.first_name')
            ->groupBy('employees.id','employees.first_name')
            ->get();
            // print($doctors);
          $this->doctors = $doctors;
          $this->isEmployee = false;
        }
 
        $this->events = json_encode($events);
 
        return view('livewire.schedule.schedule')->with('showModal', $this->showModal);
    }

    public function closeModal()
    {
        $this->emit('closeModal');
        $this->showModal = false;
    }
}