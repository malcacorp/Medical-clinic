<?php

namespace App\Http\Livewire\Patients2;

use App\Models\MedicalAssessment;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Team;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;

class PatientsForms extends Component
{
    use WithFileUploads;

  public $patients, $last_name, $first_name, $id_number, $sex, $address, $email, $birthdate, $phone_number, $weight, $height, $eye_color;
  public $file, $photo;
  public $patient_id, $user_id, $assessment_id;
  public $user, $patient, $patient_file_path, $histories, $historyToShow, $positionPage, $totalPatientHistories;
  public $assessment_type, $temperature, $blood_pressure, $medical_condition, $medical_history, $alergic, $alergies, $medical_concerns, $diagnostic, $treatment, $active_assessment= true, $previous_illnesses ;

  // Pediatrics fields
  public $maternal_age, $gestas_ped, $paras, $abortos_ped, $controlled_pregnancy, $consultations_count;
  public $pregnancy_complications, $serology, $mother_blood_type, $father_blood_type, $urinalysis;
  public $delivery_method, $gestational_weeks, $cesarean_indication, $apgar_1, $apgar_5;
  public $amniotic_liquid, $other_complications;
  public $pan, $tan, $cc_neonatal, $ct_neonatal, $ca_neonatal;
  public $breathed_cried, $hospitalized_at_birth, $gestational_age_weeks, $method_capurro_ballard, $neonatal_observations;
  public $lme_months, $formula_months, $formula_indication, $ablactation_months, $family_diet_incorporation;
  public $milestones, $habits_ped, $physical_exam_ped, $percentiles, $vaccines;
  public $family_history_ped, $plan_ped, $objective_ped, $subjective_ped;

  // Gynecology fields
  public $fur, $menarquia, $cycles, $sexual_activity, $coitarche, $partners, $contraceptive;
  public $papanicolaou, $mammography;
  public $gestas, $partos, $cesareas, $abortos, $ectopicos, $last_delivery, $obstetric_complications;
  public $family_history, $habits, $physical_exam_gyneco, $current_illness, $requested_exams, $management_plan;

  public $isOpenCreate = true;
  public $isOpenCreateTwo = false;
  public $isOpenCondition = false;
  public $isOpenConditionTwo = false;
  public $isOpenPediatrics = false;
  public $isOpenGynecology = false;
  public $isOpenHistories = false;
  public $isShowHistory = false;

  public function redirectToRoute($patients2)
  {
    return redirect()->route('patients2');
  }


  /* STORE */
  public function store()
  {
    $this->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'sex' => 'required',
      'weight' => ['required', 'numeric'],
      'height' => ['required', 'numeric'],
      'id_number' => ['required', Rule::unique('patients')->ignore($this->patient_id)],
      'phone_number' => 'required_without_all:email', 
      'email' => ['string', 'email', 'max:125', Rule::unique('users')->ignore($this->user_id)],
      'birthdate' => ['required', 'date', 'date_format:Y-m-d', 'before:today', 'after:1920-01-01'],
      'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
      'address' => 'required',
    ]);

    $email = $this->email ? $this->email : $this->id_number . '@gmail.com';

    $user = User::firstOrNew(
      ['id' => $this->user_id], // Condición de búsqueda
      [
        'name' => $this->first_name . ' ' . $this->last_name,
        'email' => $email,
        'password' => Hash::make($this->id_number),
      ]
    );

    if (!$user->exists) {
      $user->save();
      $this->createTeam($user);
    }


    if (isset($this->photo)) {
      $user->updateProfilePhoto($this->photo);
    }

    $patient = Patient::updateOrCreate(['id' => $this->patient_id], [
      'last_name' => strtoupper($this->last_name),
      'first_name' => strtoupper($this->first_name),
      'id_number' => $this->id_number,
      'sex' => $this->sex,
      'email' => $email,
      'phone_number' => $this->phone_number,
      'birthdate' => $this->birthdate,
      'weight' => $this->weight,
      'height' => $this->height,
      'eye_color' => strtoupper($this->eye_color),
      'address' => strtoupper($this->address),
      'user_id' => null,
    ]);

    $user->patient()->save($patient);

    $rolePatient = Role::where('name', 'patient')->first();
    $user->assignRole($rolePatient);

    $this->user = $user;

    $message = Markdown::parse(nl2br("Hola, " . $patient->first_name . ".\n\n Bienvenido(a) a Clínica La Esperanza. \n\n Puedes reservar una cita haciendo click en el enlace abajo. \n\n [Ir a Clinic Software](https://secure.esperanzavalencia.com) "));

    $details = [
        'title' => "Bienvenido(a) a Clínica La Esperanza.",
        'subject' => "Bienvenido(a) a Clínica La Esperanza.",
        'message' => $message,
    ];

    Mail::to([$email])->send(new SendMail($details));

    session()->flash('message', $this->patient_id ? 'Patient Updated Successfully.' : 'Patient Created Successfully.');
    $this->patient_id = $patient->id;
    $this->user_id = $user->id;
    $this->patient = Patient::find($this->patient_id);
    return true;
  }
  /* END STORE */

  /* HANDLE_TABS */
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public function create()
  {
    $this->closeList();
    $this->resetInputFields();
    $this->openCreateUpdate();
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public function openCreateUpdate()
  {
    $this->isOpenCreate = true;
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
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
    $this->last_name = '';
    $this->first_name = '';
    $this->id_number = '';
    $this->sex = '';
    $this->patient_id = '';
    $this->email = '';
    $this->phone_number = '';
    $this->birthdate = '';
    $this->weight = '';
    $this->height = '';
    $this->eye_color = '';
    $this->address = '';
    $this->patient_file_path = null;

    $this->blood_pressure = '';
    $this->temperature = '';
    $this->medical_condition = '';

    $this->medical_history = '';
    $this->previous_illnesses = '';
    $this->alergic = '';
    $this->alergies = '';
    $this->medical_concerns = '';
    $this->diagnostic = '';
    $this->treatment = '';
    $this->previous_illnesses = '';
    $this->active_assessment = true;

    // Pediatrics
    $this->maternal_age = null;
    $this->gestas_ped = null;
    $this->paras = null;
    $this->abortos_ped = null;
    $this->controlled_pregnancy = null;
    $this->consultations_count = null;
    $this->pregnancy_complications = '';
    $this->serology = '';
    $this->mother_blood_type = '';
    $this->father_blood_type = '';
    $this->urinalysis = '';
    $this->delivery_method = '';
    $this->gestational_weeks = null;
    $this->cesarean_indication = '';
    $this->apgar_1 = null;
    $this->apgar_5 = null;
    $this->amniotic_liquid = '';
    $this->other_complications = '';
    $this->pan = null;
    $this->tan = null;
    $this->cc_neonatal = null;
    $this->ct_neonatal = null;
    $this->ca_neonatal = null;
    $this->breathed_cried = null;
    $this->hospitalized_at_birth = null;
    $this->gestational_age_weeks = null;
    $this->method_capurro_ballard = '';
    $this->neonatal_observations = '';
    $this->lme_months = null;
    $this->formula_months = null;
    $this->formula_indication = '';
    $this->ablactation_months = null;
    $this->family_diet_incorporation = null;
    $this->milestones = '';
    $this->habits_ped = '';
    $this->physical_exam_ped = '';
    $this->percentiles = '';
    $this->vaccines = '';
    $this->family_history_ped = '';
    $this->plan_ped = '';
    $this->objective_ped = '';
    $this->subjective_ped = '';

    // Gynecology
    $this->fur = '';
    $this->menarquia = '';
    $this->cycles = '';
    $this->sexual_activity = null;
    $this->coitarche = '';
    $this->partners = null;
    $this->contraceptive = '';
    $this->papanicolaou = '';
    $this->mammography = '';
    $this->gestas = null;
    $this->partos = null;
    $this->cesareas = null;
    $this->abortos = null;
    $this->ectopicos = null;
    $this->last_delivery = '';
    $this->obstetric_complications = '';
    $this->family_history = '';
    $this->habits = '';
    $this->physical_exam_gyneco = '';
    $this->current_illness = '';
    $this->requested_exams = '';
    $this->management_plan = '';
  }

  public function resetComponent()
  {
    $this->isOpenCreate = true;
    $this->isOpenCreateTwo = false;
    $this->isOpenCondition = false;
    $this->isOpenConditionTwo = false;
    $this->isOpenPediatrics = false;
    $this->isOpenGynecology = false;
    $this->isOpenHistories = false;
  }
  /* END HANDLE_TABS */

  /* DATES EDIT */
  public function mount($id = null, $toShow = null, $toAss = null)
  {
    if ($id != null) {
      $patient = Patient::find(intval($id));
      // dd($patient);
      $this->patient_id = $id;
      if ($patient) {
          $this->user_id = $patient->user_id;
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
          $this->patient_file_path = $patient->patient_file_path;
          $this->user = User::find($this->user_id);
          $this->patient = $patient;
          $this->histories = \App\Models\MedicalAssessment::where('patient_id', $this->patient_id)->get();
      }
      if ($toShow != null && $toShow == "histories") {
        // dd($toShow);
        $this->showHistories($id);
        $this->isOpenCreate = false;
      }
      if ($toShow != null && $toShow == "assessment") {
        $this->assessment($id);
        $this->isOpenCreate = false;
      }
    } else {
      $this->patient = [];
      $this->histories = collect();
    }
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  public function edit($id = null)
  {
    $patient = Patient::find($id);
    $this->patient_id = $id;
    $this->user_id = $patient->user_id;
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
    $this->patient_file_path = $patient->patient_file_path;

    $this->user = User::find($this->user_id);
    $this->patient = Patient::find($id);

    $this->histories = MedicalAssessment::where('patient_id', $this->patient_id)->get();

    // $this->openCreateUpdate();
    // $this->closeList();
  }

  public function editAssessment()
  {
    $assessment = MedicalAssessment::where('patient_id', $this->patient_id)->where('active', 1)->first();
    if ($assessment) {
      $this->assessment_id = $assessment->id;
      $this->assessment_type = $assessment->assessment_type;
      $this->weight = $assessment->weight;
      $this->height = $assessment->height;
      $this->temperature = $assessment->temperature;
      $this->blood_pressure = $assessment->blood_pressure;
      $this->medical_condition = $assessment->medical_condition;
      $this->medical_history = $assessment->medical_history;
      $this->previous_illnesses = $assessment->previous_illnesses;
      $this->alergic = $assessment->alergic;
      $this->alergies = $assessment->alergies;
      $this->medical_concerns = $assessment->medical_concerns;
      $this->diagnostic = $assessment->diagnostic;
      $this->treatment = $assessment->treatment;
      $this->active_assessment = $assessment->active_assessment;

      // Pediatrics
      if ($assessment->assessment_type === 'Pediatrics') {
        $this->maternal_age = $assessment->maternal_age;
        $this->gestas_ped = $assessment->gestas_ped;
        $this->paras = $assessment->paras;
        $this->abortos_ped = $assessment->abortos_ped;
        $this->controlled_pregnancy = $assessment->controlled_pregnancy;
        $this->consultations_count = $assessment->consultations_count;
        $this->pregnancy_complications = $assessment->pregnancy_complications;
        $this->serology = $assessment->serology;
        $this->mother_blood_type = $assessment->mother_blood_type;
        $this->father_blood_type = $assessment->father_blood_type;
        $this->urinalysis = $assessment->urinalysis;
        $this->delivery_method = $assessment->delivery_method;
        $this->gestational_weeks = $assessment->gestational_weeks;
        $this->cesarean_indication = $assessment->cesarean_indication;
        $this->apgar_1 = $assessment->apgar_1;
        $this->apgar_5 = $assessment->apgar_5;
        $this->amniotic_liquid = $assessment->amniotic_liquid;
        $this->other_complications = $assessment->other_complications;
        $this->pan = $assessment->pan;
        $this->tan = $assessment->tan;
        $this->cc_neonatal = $assessment->cc_neonatal;
        $this->ct_neonatal = $assessment->ct_neonatal;
        $this->ca_neonatal = $assessment->ca_neonatal;
        $this->breathed_cried = $assessment->breathed_cried;
        $this->hospitalized_at_birth = $assessment->hospitalized_at_birth;
        $this->gestational_age_weeks = $assessment->gestational_age_weeks;
        $this->method_capurro_ballard = $assessment->method_capurro_ballard;
        $this->neonatal_observations = $assessment->neonatal_observations;
        $this->lme_months = $assessment->lme_months;
        $this->formula_months = $assessment->formula_months;
        $this->formula_indication = $assessment->formula_indication;
        $this->ablactation_months = $assessment->ablactation_months;
        $this->family_diet_incorporation = $assessment->family_diet_incorporation;
        $this->milestones = $assessment->milestones;
        $this->habits_ped = $assessment->habits_ped;
        $this->physical_exam_ped = $assessment->physical_exam_ped;
        $this->percentiles = $assessment->percentiles;
        $this->vaccines = $assessment->vaccines;
        $this->family_history_ped = $assessment->family_history_ped;
        $this->plan_ped = $assessment->plan_ped;
        $this->objective_ped = $assessment->objective_ped;
        $this->subjective_ped = $assessment->subjective_ped;
      }

      // Gynecology
      if ($assessment->assessment_type === 'Gynecology') {
        $this->fur = $assessment->fur;
        $this->menarquia = $assessment->menarquia;
        $this->cycles = $assessment->cycles;
        $this->sexual_activity = $assessment->sexual_activity;
        $this->coitarche = $assessment->coitarche;
        $this->partners = $assessment->partners;
        $this->contraceptive = $assessment->contraceptive;
        $this->papanicolaou = $assessment->papanicolaou;
        $this->mammography = $assessment->mammography;
        $this->gestas = $assessment->gestas;
        $this->partos = $assessment->partos;
        $this->cesareas = $assessment->cesareas;
        $this->abortos = $assessment->abortos;
        $this->ectopicos = $assessment->ectopicos;
        $this->last_delivery = $assessment->last_delivery;
        $this->obstetric_complications = $assessment->obstetric_complications;
        $this->family_history = $assessment->family_history;
        $this->habits = $assessment->habits;
        $this->physical_exam_gyneco = $assessment->physical_exam_gyneco;
        $this->current_illness = $assessment->current_illness;
        $this->requested_exams = $assessment->requested_exams;
        $this->management_plan = $assessment->management_plan;
      }
    }
  }
  /* ---------- COMPONENTS --------- */

  public function delete($id)
  {
    Patient::find($id)->delete();
    session()->flash('message', 'Patient Deleted Successfully.');
  }

  protected function createTeam(User $user): void
  {
    $user->ownedTeams()->save(Team::forceCreate([
      'user_id' => $user->id,
      'name' => explode(' ', $user->name, 2)[0] . "'s Team",
      'personal_team' => true,
    ]));
  }

  public function savePatientFile()
  {
    $this->validate([
      'file' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'], // 1MB Max
    ]);

    if (isset($this->file)) {
      $this->updatePatientFile($this->file);
      session()->flash('message', 'File updated successfully.');
    }
    $this->handleTabs('isOpenCondition', 'isOpenCreateTwo', 'editAssessment');
    return;

    // session()->flash('message','Error on uploading.');
  }

  /**
   * 
   * Update the patient's file.
   *
   * @param  \Illuminate\Http\UploadedFile  $file
   * @param  string  $storagePath
   * @return void
   */
  public function updatePatientFile(UploadedFile $file, $storagePath = 'files')
  {
    tap($this->patient_file_path, function ($previous) use ($file, $storagePath) {
      $this->patient->update([
        'patient_file_path' => $this->file->storePublicly($storagePath, ['disk' => $this->patientFileDisk()])
      ]);

      if ($previous) {
        Storage::disk($this->patientFileDisk())->delete($previous);
      }
    });
  }

  /**
   * Delete the patient's file.
   *
   * @return void
   */
  public function deletePatientFile()
  {

    if (is_null($this->patient_file_path)) {
      return;
    }

    Storage::disk($this->patientFileDisk())->delete($this->patient_file_path);

    $this->patient->update([
      'patient_file_path' => null
    ]);

    $this->patient_file_path = null;
  }

  /**
   * Get the disk that patient files should be stored on.
   *
   * @return string
   */
  protected function patientFileDisk()
  {
    return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.file_disk', 'public');
  }

  /**
   * Delete the user's profile photo.
   *
   * @return void
   */
  public function deleteProfilePhoto()
  {
    $this->user->deleteProfilePhoto();
  }

  public function updateAssessment()
  {
    $this->validate([
      'weight' => ['required', 'numeric'],
      'height' => ['required', 'numeric'],
    //   'blood_pressure' => 'required',
      'medical_condition' => 'required',
    ]);

    $currentUser = Auth::user();

    return DB::transaction(function () use ($currentUser) {
      return tap(
        MedicalAssessment::updateOrCreate(['id' => $this->assessment_id], [
          'employee_id' => $currentUser->hasRole('doctor') ? $currentUser->employee->id : null,
          'nurse_id' => $currentUser->hasRole('nurse') ? $currentUser->employee->id : null,
          'assessment_type' => $this->assessment_type,
          'height' => $this->height,
          'weight' => $this->weight,
          'temperature' => $this->temperature,
          'blood_pressure' => $this->blood_pressure,
          'medical_condition' => $this->medical_condition,
          'medical_history' => $this->medical_history,
          'alergic' => $this->alergic,
          'alergies' => $this->alergies,
          'medical_concerns' => $this->medical_concerns,
          'diagnostic' => $this->diagnostic,
          'treatment' => $this->treatment,
          'previous_illnesses' => $this->previous_illnesses,
          'active' => $this->active_assessment != null ? intval($this->active_assessment) : 1,
          // Pediatrics
          'maternal_age' => $this->maternal_age,
          'gestas_ped' => $this->gestas_ped,
          'paras' => $this->paras,
          'abortos_ped' => $this->abortos_ped,
          'controlled_pregnancy' => $this->controlled_pregnancy,
          'consultations_count' => $this->consultations_count,
          'pregnancy_complications' => $this->pregnancy_complications,
          'serology' => $this->serology,
          'mother_blood_type' => $this->mother_blood_type,
          'father_blood_type' => $this->father_blood_type,
          'urinalysis' => $this->urinalysis,
          'delivery_method' => $this->delivery_method,
          'gestational_weeks' => $this->gestational_weeks,
          'cesarean_indication' => $this->cesarean_indication,
          'apgar_1' => $this->apgar_1,
          'apgar_5' => $this->apgar_5,
          'amniotic_liquid' => $this->amniotic_liquid,
          'other_complications' => $this->other_complications,
          'pan' => $this->pan,
          'tan' => $this->tan,
          'cc_neonatal' => $this->cc_neonatal,
          'ct_neonatal' => $this->ct_neonatal,
          'ca_neonatal' => $this->ca_neonatal,
          'breathed_cried' => $this->breathed_cried,
          'hospitalized_at_birth' => $this->hospitalized_at_birth,
          'gestational_age_weeks' => $this->gestational_age_weeks,
          'method_capurro_ballard' => $this->method_capurro_ballard,
          'neonatal_observations' => $this->neonatal_observations,
          'lme_months' => $this->lme_months,
          'formula_months' => $this->formula_months,
          'formula_indication' => $this->formula_indication,
          'ablactation_months' => $this->ablactation_months,
          'family_diet_incorporation' => $this->family_diet_incorporation,
          'milestones' => $this->milestones,
          'habits_ped' => $this->habits_ped,
          'physical_exam_ped' => $this->physical_exam_ped,
          'percentiles' => $this->percentiles,
          'vaccines' => $this->vaccines,
          'family_history_ped' => $this->family_history_ped,
          'plan_ped' => $this->plan_ped,
          'objective_ped' => $this->objective_ped,
          'subjective_ped' => $this->subjective_ped,
          // Gynecology
          'fur' => $this->fur ?: null,
          'menarquia' => $this->menarquia,
          'cycles' => $this->cycles,
          'sexual_activity' => $this->sexual_activity,
          'coitarche' => $this->coitarche,
          'partners' => $this->partners,
          'contraceptive' => $this->contraceptive,
          'papanicolaou' => $this->papanicolaou ?: null,
          'mammography' => $this->mammography ?: null,
          'gestas' => $this->gestas,
          'partos' => $this->partos,
          'cesareas' => $this->cesareas,
          'abortos' => $this->abortos,
          'ectopicos' => $this->ectopicos,
          'last_delivery' => $this->last_delivery ?: null,
          'obstetric_complications' => $this->obstetric_complications,
          'family_history' => $this->family_history,
          'habits' => $this->habits,
          'physical_exam_gyneco' => $this->physical_exam_gyneco,
          'current_illness' => $this->current_illness,
          'requested_exams' => $this->requested_exams,
          'management_plan' => $this->management_plan,
        ]),
        function (MedicalAssessment $medicalAssessment) {
          if (!$this->assessment_id) {
            $patient = Patient::find($this->patient_id);
            $patient->medicalAssessment()->save($medicalAssessment);

            if(Auth::user()->hasRole('doctor')){
              $employee = Employee::find(Auth::user()->employee->id);
              $employee->medical_assessment()->save($medicalAssessment);
            }

            $this->assessment_id = $medicalAssessment->id;
          }
          $this->listHistory($this->patient_id);

          //correo

          session()->flash('message', $this->patient_id ? 'Assessment Updated Successfully.' : 'Assessment Created Successfully.');
          return true;
        }
      );
    });
  }
  public function showHistories($id)
  {
    $this->edit($id);
    $this->resetComponent();
    $this->handleTabs('isOpenHistories', 'isOpenConditionTwo', $this->listHistory($id));
  }

  public function listHistory($id)
  {
    $this->histories = MedicalAssessment::where('patient_id', $id)->get();
    $this->totalPatientHistories = count($this->histories);
  }

  public function assessment($id)
  {
    $this->edit($id);
    $this->editAssessment();
    $this->resetComponent();
    $this->handleTabs('isOpenCondition', 'isOpenList');
  }

  public function showHistory($id)
  {
    $historyToShow = MedicalAssessment::where('id', $id)->first();

    foreach ($this->histories as $index => $history) {
      if ($history->id == $id) {
        $this->positionPage = $index;
      }
    }

    $timestamp = $historyToShow->created_at->timestamp;
    $historyToShow->date = date('d-m-Y', $timestamp);

    $doctor = Employee::find($historyToShow->employee_id);
    if ($doctor)
      $historyToShow->doctorName = $doctor->first_name . " " . $doctor->last_name;

    $nurse = Employee::find($historyToShow->nurse_id);
    if ($nurse)
      $historyToShow->nurseName = $nurse->first_name . " " . $nurse->last_name;

    $this->historyToShow = $historyToShow;
    $this->handleTabs('isShowHistory', 'isOpenHistories');
  }

  public function nextPage()
  {
    $this->positionPage = $this->positionPage + 1;
    $idHistoryToShow = $this->histories[$this->positionPage]->id;
    $this->showHistory($idHistoryToShow);
  }

  public function previousPage()
  {
    $this->positionPage = $this->positionPage - 1;
    $idHistoryToShow = $this->histories[$this->positionPage]->id;
    $this->showHistory($idHistoryToShow);
  }



  /* END COMPONENTS */
  public function render()
  {
    return view('livewire.patients2.patients-forms');
  }
}
