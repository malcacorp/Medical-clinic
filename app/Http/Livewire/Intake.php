<?php
namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
// use Laravel\Jetstream\Team;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Mail\Markdown;
use Livewire\Component;

use App\Models\Team;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendMail;

class Intake extends Component
    // class Intake extends Component implements CreatesNewUsers
{
    use PasswordValidationRules;

    public $email, $terms;
    public $last_name, $first_name, $id_number, $sex, $address, $birthdate, $phone_number, $weight, $height, $eye_color, $patient_id;
    public $calendar, $medical_condition, $patient;
    // public $intake, $title, $description, $post_id;
    // public $isOpenPatient = true;
    public $isOpenMedical = 0;
    public $isEdit = 0;
    public $availableDates = [], $selectedDate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        // $this->intake = Intake::all();
        // $this->resetInputFields();
        $this->availableDates = Event::leftJoin("employees AS em", "em.id", "=", "events.employee_id")
            ->select("events.*", DB::raw('DATE(start) AS date'))
            ->selectRaw("CONCAT(em.first_name, ' ', em.last_name) AS doctorName")
            ->selectRaw('SUBSTRING(start, 12, 16) as time')
            ->where("title", "=", "Available")
            ->where("start", ">=", Carbon::now())
            ->orderBy("date", "ASC")
            ->get();

        return view('livewire.intake.intake')->layout('layouts.guest');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openMedicalCondition();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openMedicalCondition()
    {
        $this->isOpenMedical = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeMedicalCondition()
    {
        $this->isOpenMedical = false;
    }

    // public function closePatientForm()
    // {
    //   $this->isOpenPatient = false;
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->patient_id = '';
        $this->last_name = '';
        $this->first_name = '';
        $this->id_number = '';
        $this->sex = '';
        $this->patient_id = '';
        $this->email = '';
        $this->terms = '';
        $this->phone_number = '';
        $this->birthdate = '';
        $this->weight = '';
        $this->height = '';
        $this->eye_color = '';
        $this->address = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'sex' => 'required',
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'id_number' => ['required', Rule::unique('patients')->ignore($this->patient_id)],
            'phone_number' => 'required_without_all:email',
            'email' => ['nullable', 'string', 'max:125'],
            'birthdate' => ['required', 'date', 'date_format:Y-m-d', 'before:today', 'after:1920-01-01'],
            'address' => 'required',
        ]);

        $email = $this->email ? $this->email : $this->id_number . '@gmail.com';

        return DB::transaction(function () use ($email) {
            $patient = Patient::updateOrCreate(['id' => $this->patient_id], [
                'first_name' => strtoupper($this->first_name),
                'last_name' => strtoupper($this->last_name),
                'id_number' => $this->id_number,
                'sex' => $this->sex,
                'email' => $email,
                'phone_number' => $this->phone_number,
                'birthdate' => $this->birthdate,
                'weight' => $this->weight,
                'height' => $this->height,
                'eye_color' => strtoupper($this->eye_color),
                'address' => $this->address,
                'user_id' => null,
            ]);

            $this->patient_id = $patient->id;
            $this->patient = $patient;

            $message = Markdown::parse(nl2br("Hola, " . $patient->first_name . ".\n\n Bienvenido(a) a Clínica La Esperanza. \n\n Puedes reservar una cita llamando a nuestros teléfonos. \n\n [Ir a Clinic Software](https://secure.esperanzavalencia.com) "));

            $details = [
                'title' => "Bienvenido(a) a Clínica La Esperanza.",
                'subject' => "Bienvenido(a) a Clínica La Esperanza.",
                'message' => $message,
            ];

            if ($this->email) {
                Mail::to([$this->email])->send(new SendMail($details));
            }

            session()->flash(
                'message',
                $this->patient_id ? 'Patient Updated Successfully.' : 'Patient Created Successfully.'
            );

            $this->isEdit = true;
            $this->openMedicalCondition();
            return true;
        });
    }

    public function addAppointment()
    {
        $selectedDate = explode("|", $this->selectedDate);
        $relatedEvent = Event::where("id", $selectedDate[0])->first();

        $appointment = Appointment::create([
            'date' => $selectedDate[2],
            'time' => $selectedDate[3],
            'medical_concerns' => $this->medical_condition,
            // 'assessment_type' => $this->assessment_type,
            'status' => 'Pending',
        ]);

        $employee = Employee::find(intval($selectedDate[1]))->first();
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

        return redirect()->route("dashboard");

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit()
    {
        $patient = Patient::findOrFail($this->patient_id);
        // $this->patient_id = $id;
        $this->last_name = $patient->last_name;
        $this->first_name = $patient->first_name;
        $this->id_number = $patient->id_number;
        $this->sex = $patient->sex;
        $this->email = $patient->email;
        $this->phone_number = $patient->phone_number;
        $this->birthdate = $patient->birthdate;
        $this->weight = $patient->weight;
        $this->height = $patient->height;
        $this->eye_color = $patient->eye_color;
        $this->address = $patient->address;

        $this->openMedicalCondition();
    }

    public function update()
    {
        $patient = Patient::updateOrCreate(['id' => $this->patient_id], [
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'id_number' => $this->id_number,
            'sex' => $this->sex,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'birthdate' => $this->birthdate,
            'weight' => $this->weight,
            'height' => $this->height,
            'eye_color' => $this->eye_color,
            'address' => $this->address,
        ]);

        $this->openMedicalCondition();
    }

    public function schedule()
    {
        return redirect()->to('/dashboard');
    }


}