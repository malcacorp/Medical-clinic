<?php
namespace App\Http\Livewire;

use App\Actions\Fortify\PasswordValidationRules;
// use Laravel\Jetstream\Team;
use Illuminate\Mail\Markdown;
use Livewire\Component;

use App\Models\Team;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class Intake extends Component
// class Intake extends Component implements CreatesNewUsers
{
  use PasswordValidationRules;

  public $email, $password, $password_confirmation, $terms;
  public $user, $last_name, $first_name, $id_number, $sex = "Male", $address, $birthdate, $phone_number, $weight, $height, $eye_color, $patient_id;
  public $calendar, $medical_condition;
  // public $intake, $title, $description, $post_id;
  // public $isOpenPatient = true;
  public $isOpenMedical = 0;
  public $isEdit = 0;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public function render()
  {
    // $this->intake = Intake::all();
    // $this->resetInputFields();
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
    $this->password = '';
    $this->password_confirmation = '';
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
      'id_number' => ['required', Rule::unique('patients')->ignore($this->patient_id)],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => $this->passwordRules(),
      'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ]);

    return DB::transaction(function () {
      return tap(
        User::create([
          'name' => $this->first_name . ' ' . $this->last_name,
          'email' => $this->email,
          'password' => Hash::make($this->password),
        ]),
        function (User $user) {
          $this->createTeam($user);
          $patient = Patient::updateOrCreate(['id' => $this->patient_id], [
              'first_name' => strtoupper($this->first_name),
              'last_name' => strtoupper($this->last_name),
              'id_number' => $this->id_number,
              'sex' => $this->sex,
              'email' => $this->email,
              'phone_number' => $this->phone_number,
              'birthdate' => $this->birthdate,
              'weight' => $this->weight,
              'height' => $this->height,
              'eye_color' => strtoupper($this->eye_color),
              'address' => $this->address,
              'user_id' => null,
              ]);
          $user->patient()->save($patient);
          
          $rolePatient = Role::where('name', 'patient')->first();
          $user->assignRole($rolePatient);

          $this->patient_id = $patient->id;
          $this->user = $user;
          $message = Markdown::parse(nl2br("Hola, ". $patient->first_name. ".\n\n Bienvenido(a) a Clínica La Esperanza. \n\n Puedes reservar una cita haciendo click en el enlace abajo. \n\n [Ir a Clinic Software](https://malcamedia.com) "));

          $details = [
            'title' => "Bienvenido(a) a Clínica La Esperanza.",
            'subject' => "Bienvenido(a) a Clínica La Esperanza.",            
            'message' => $message,
          ];

          Mail::to([$this->email])->send(new SendMail($details));

          session()->flash(
            'message',
            $this->patient_id ? 'Patient Updated Successfully.' : 'Patient Created Successfully.'
          );

          $this->isEdit = true;
          $this->openMedicalCondition();
        }
      );
    });
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

  public function update(){
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

    public function schedule(){
      return redirect()->to('/dashboard');
    }

  /**
   * Create a personal team for the user.
   */
  protected function createTeam(User $user): void
  {
    $user->ownedTeams()->save(Team::forceCreate([
      'user_id' => $user->id,
      'name' => explode(' ', $user->name, 2)[0] . "'s Team",
      'personal_team' => true,
    ]));
  }
}