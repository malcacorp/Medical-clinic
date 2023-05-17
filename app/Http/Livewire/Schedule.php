<?php
namespace App\Http\Livewire;
use App\Models\Appointment;
use Livewire\Component;
use App\Models\Event;
use App\Models\Employee;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
 
class Schedule extends Component
{
    public $events = '';
    public $title;
    public $info;
    public $isEmployee;
    public $isAdmin;
    public $selectedDate, $availableDates = [];
    public $doctors = [];
    public $doctorSelected;
    public $currentAppointmentId;
    public $currentAppointmentDate = "", $currentAppointmentTime = "", $currentAppointmentPatient = "", $currentAppointmentReason = ""; 
    public $currentAppointmentPhone = "", $currentAppointmentPatientId;
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
            $input['status'] = "Pending";
            $appointment = Appointment::create($input);
  
            $employee->appointments()->save($appointment);
            $patient->appointments()->save($appointment);
            
            $input['title'] = "Appointment";
            $input['start'] = $appointment['date'].'T'.$appointment['time'];
            // $event = Event::create($input);
            $availability->appointment()->save($appointment);
            $employee->events()->save($availability);
            $availability->update([
              'title' => 'Appointment'
            ]);
            $this->reset();
            
            $this->emit('eventRemoved', $availability->id);
            $this->emit('eventAdded', $availability->id, $availability->title." ".$patient->first_name." ".$patient->last_name, $availability->start );
            // $availability->delete();
            // return redirect()->route('schedule');
          }else
            $this->emit('notAvailability');
          
        }else
          $this->emit('isNotPatient');
    }

    public function showAppointment($id){
      // $currentEvent = Event::find(intval($id));
      $currentEvent = Event::leftJoin('appointments', 'appointments.event_id', '=', 'events.id')
                  ->leftJoin('patients', 'patients.id', '=', 'appointments.patient_id')
                  ->select('events.id','events.title','appointments.date','appointments.time', 'appointments.medical_concerns', 'patients.id as patient_id', 'patients.first_name', 'patients.last_name', 'patients.phone_number', 'appointments.id AS appointment_id')
                  ->where('events.id', $id)
                  // ->orWhere('title', 'Available')
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
      $this->currentAppointmentId = $currentEvent->appointment_id;
      $this->currentAppointmentPatientId = $currentEvent->patient_id;
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
        //Profile redirect
    public function openProfile($id){
      return redirect()->route('patient-edit', ['id' => $id]); 
    }
    //End Profile redirect
    public function render()
    {
        $user = auth()->user();
        // dd($user->roles->contains('name', 'nurse'));
        $employee = Employee::where('user_id', $user->id)->first();
        $this->isAdmin = $user->roles->contains('name', 'admin');
        if($employee){
          $this->isEmployee = true;
          $isNurse = $user->roles->contains('name', 'nurse');
          $isDoctor = $user->roles->contains('name', 'doctor');

          if($isNurse){
            $availables = Event::select('id','title','start')->get();
            $appointments = Event::join('appointments', 'appointments.event_id', '=', 'events.id')
                            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                            ->select('events.id','start')
                            ->selectRaw("CONCAT(events.title, ' ', patients.first_name, ' ', patients.last_name) AS title")
                            ->where('appointments.status', 'Pending')->get();
            $events = $availables->merge($appointments); 
          }

          if($isDoctor){
            $availables = Event::select('id','title','start')->where('employee_id', $employee->id)->get();
            $appointments = Event::join('appointments', 'appointments.event_id', '=', 'events.id')
                            ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                            ->select('events.id','start')
                            ->selectRaw("CONCAT(events.title, ' ', patients.first_name, ' ', patients.last_name) AS title")
                            ->where('events.employee_id', $employee->id)
                            ->where('appointments.status', 'Pending')->get();
                            $events = $availables->merge($appointments); 
          }                     
        }else{
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
          }elseif($this->isAdmin){
              $availables = Event::select('id','title','start')->get();
              $appointments = Event::join('appointments', 'appointments.event_id', '=', 'events.id')
                              ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                              ->select('events.id','start')
                              ->selectRaw("CONCAT(events.title, ' ', patients.first_name, ' ', patients.last_name) AS title")
                              ->where('appointments.status', 'Pending')->get();
              $events = $availables->merge($appointments); 
            }else{
              $events = Event::select('id','title','start')->where('title', 'Available')->get();
            }
          
          $this->availableDates = Event::leftJoin("employees AS em", "em.id", "=", "events.employee_id")
                                        ->select("events.*", DB::raw('DATE(start) AS date'))
                                        ->selectRaw("CONCAT(em.first_name, ' ', em.last_name) AS doctorName")
                                        ->selectRaw('SUBSTRING(start, 12, 16) as time')
                                        ->where("title", "=", "Available")->get();

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

    public function cancelAppointment(){
      // dd($this->currentAppointmentId);
      $appointment = Appointment::find($this->currentAppointmentId);
      $appointment->status = 'Canceled';
      $appointment->save();

      $appointment->event()->update([
        'title' => 'Available'
      ]);

      session()->flash('message', 'Appointment deleted successfully.');
      return redirect()->route('schedule');
    }

    public function updateSelectedDate($id){
      $selected = Event::leftJoin("employees AS em", "em.id", "=", "events.employee_id")
                        ->select("events.*", DB::raw('DATE(start) AS date'))
                        ->selectRaw("CONCAT(em.first_name, ' ', em.last_name) AS doctorName")
                        ->selectRaw('SUBSTRING(start, 12, 16) as time')
                        ->where("title", "=", "Available")
                        ->where("events.id", $id)
                        ->first();
      $this->emit('updateSelectedDate', $selected->id, $selected->employee_id, $selected->date, $selected->time );      
    }
}