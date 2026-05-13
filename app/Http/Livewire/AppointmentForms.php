<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Appointment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Markdown;
use App\Mail\SendMail;

class AppointmentForms extends Component
{
    public $doctors = [];
    public $doctorSelected;
    public $patients, $last_name, $first_name, $medical_concerns, $patient_id;
    public $appointments, $appointment_id, $name, $event;
    public $appointment, $assessment_type, $selectedDate, $availableDates = [];
    public $isEdit = false;


    public function mount($id = null, $status = null, $toShow = null, $toAss = null)
    {
        $this->patients = Patient::all();
        $this->doctors = Employee::where('position', 'DOCTOR')->get();

        if ($id != null) {
            $this->appointment = Appointment::findOrFail(intval($id));

            $this->selectedDate = $this->appointment->event_id . "|" . $this->appointment->employee_id . "|" . $this->appointment->date . "|" . $this->appointment->time;

            $this->patient_id = $this->appointment->patient_id;
            $this->medical_concerns = $this->appointment->medical_concerns;
            $this->assessment_type = $this->appointment->assessment_type;

            $this->event = Event::find($this->appointment->event_id);
            $this->isEdit = true;
        }
    }

    public function render()
    {
        if (!$this->appointment) {
            $this->availableDates = Event::leftJoin("employees AS em", "em.id", "=", "events.employee_id")
                ->select("events.*", DB::raw('DATE(start) AS date'))
                ->selectRaw("CONCAT(em.first_name, ' ', em.last_name) AS doctorName")
                ->selectRaw('SUBSTRING(start, 12, 19) as time')
                ->where("title", "=", "Available")->get();
        } else {
            $availableDates = Event::leftJoin("employees AS em", "em.id", "=", "events.employee_id")
                ->select("events.*", DB::raw('DATE(start) AS date'))
                ->selectRaw("CONCAT(em.first_name, ' ', em.last_name) AS doctorName")
                ->selectRaw('SUBSTRING(start, 12, 19) as time')
                ->where("title", "=", "Available")
                ->where("start", ">=", Carbon::now())
                ->get();

            $selectedDate = Event::leftJoin("employees AS em", "em.id", "=", "events.employee_id")
                ->select("events.*", DB::raw('DATE(start) AS date'))
                ->selectRaw("CONCAT(em.first_name, ' ', em.last_name) AS doctorName")
                ->selectRaw('SUBSTRING(start, 12, 19) as time')
                ->where("events.id", $this->appointment->event_id)
                ->get();

            $this->availableDates = $availableDates->merge($selectedDate);
        }

        return view('livewire.appointment.appointment');
    }

    public function store()
    {
        $this->validate([
            'selectedDate' => 'required',
            'medical_concerns' => 'required',
            'assessment_type' => 'required',
        ]);

        $selectedDate = explode("|", $this->selectedDate);

        $relatedEvent = Event::where("id", $selectedDate[0])->first();

        if ($this->appointment) {
            // dd($this->appointment->event_id, intval($selectedDate[0]));
            $this->appointment->update([
                'date' => $selectedDate[2],
                'time' => $selectedDate[3],
                'employee_id' => $selectedDate[1],
                'medical_concerns' => $this->medical_concerns,
                'assessment_type' => $this->assessment_type,
            ]);

            if ($this->appointment->event_id != intval($selectedDate[0])) {
                $this->event->update([
                    'title' => 'Available'
                ]);

                $newEvent = Event::find(intval($selectedDate[0]));
                $newEvent->appointment()->save($this->appointment);
                $newEvent->update([
                    'title' => 'Appointment'
                ]);
            }


        } else {
            $appointment = Appointment::create([
                'date' => $selectedDate[2],
                'time' => $selectedDate[3],
                'medical_concerns' => $this->medical_concerns,
                'assessment_type' => $this->assessment_type,
                'status' => 'Pending',
            ]);

            $employee = Employee::find(intval($selectedDate[1]));
            $patient = Patient::find($this->patient_id);

            $patient->appointments()->save($appointment);
            $employee->appointments()->save($appointment);

            $relatedEvent->update([
                'start' => $selectedDate[2] . 'T' . $selectedDate[3],
                'title' => 'Appointment'
            ]);

            $relatedEvent->appointment()->save($appointment);

            $message = Markdown::parse(nl2br("Hola, " . $patient->first_name . ".\n\n Tu cita médica con el Dr. (Dra.) " . $employee->first_name . " " . $employee->last_name . " será el día " . $appointment->date . " a las " . $appointment->time . ". \n\n Si necesitas cancelar tu cita, puedes hacer click en el enlace abajo. \n\n [Ir a Clinic Software](https://secure.esperanzavalencia.com) "));

            $details = [
                'title' => "Confirmación de Cita Médica",
                'subject' => "Confirmación de Cita Médica",
                'message' => $message,
            ];

            Mail::to([$patient->email])->send(new SendMail($details));

            $this->reset();
        }
        session()->flash('success', 'Appointment ' . ($this->appointment ? 'updated' : 'created') . ' successfully.');

        return redirect()->route('appointments');
    }

    public function delete()
    {
        // dd($this->appointment->id);
        $appointment = Appointment::find($this->appointment->id);
        $appointment->status = 'Canceled';
        $appointment->save();

        $message = Markdown::parse(nl2br("Hola, " . $appointment->patient->first_name . ".\n\n Tu cita médica con el Dr. (Dra.) " . $appointment->employee->first_name . " " . $appointment->employee->last_name . ",  el día " . $appointment->date . " a las " . $appointment->time . ", ha sido Cancelada. \n\n [Ir a Clinic Software](https://secure.esperanzavalencia.com) "));

        $details = [
            'title' => "Cancelación de Cita Médica",
            'subject' => "Cancelación de Cita Médica",
            'message' => $message,
        ];

        Mail::to([$appointment->patient->email])->send(new SendMail($details));

        $appointment->event()->update([
            'title' => 'Available'
        ]);

        $this->appointment->event()->dissociate();
        // Guardar los cambios
        $this->appointment->save();

        session()->flash('message', 'Appointment deleted successfully.');
        return redirect()->route('appointments');
    }

}
