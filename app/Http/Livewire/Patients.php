<?php
namespace App\Http\Livewire;
use App\Models\MedicalAssessment;
use Livewire\Component;
use App\Models\Patient;
use App\Models\Employee;

use App\Models\Team;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;

class Patients extends Component
{
    use WithFileUploads;

    public $patients, $last_name, $first_name, $id_number, $sex, $address, $email, $birthdate, $phone_number, $weight, $height, $eye_color;
    public $file, $photo;
    public $patient_id, $user_id, $assessment_id;
    public $user, $patient, $patient_file_path, $histories, $historyToShow;
    public $assessment_type, $temperature, $blood_pressure, $medical_condition, $medical_history, $alergic, $alergies, $medical_concerns, $diagnostic, $treatment, $active_assessment=true;
    public $isOpenList = true;
    public $isOpenCreate = false;

    public $isOpenCreateTwo = false;
    public $isOpenCondition = false;
    public $isOpenConditionTwo = false;
    public $isOpenHistories = false;
    public $isShowHistory = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    public function render()
    {
        $this->patients = Patient::all();
        return view('livewire.patients.index');
    }
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
    public function openList()
    {
        $this->isOpenList = true;
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
    public function closeList()
    {
        $this->isOpenList = false;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function handleTabs($toOpen, $toClose, $method = null){
      if($method!=null){
        if($this->$method()){
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
    private function resetInputFields(){
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
        $this->alergic = '';
        $this->alergies = '';
        $this->medical_concerns = '';
        $this->diagnostic = '';
        $this->treatment = '';
        $this->active_assessment=true;
    }

    public function resetComponent() {
      $this->isOpenList = false;
      $this->isOpenCreate = false;  
      $this->isOpenCreateTwo = false;
      $this->isOpenCondition = false;
      $this->isOpenConditionTwo = false;
      $this->isOpenHistories = false;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'id_number' => ['required', Rule::unique('patients')->ignore($this->patient_id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'address' => 'required',
        ]);

        $user = User::firstOrNew(['id' => $this->user_id], // Condición de búsqueda
            [  
              'name' => $this->first_name . ' ' . $this->last_name,
              'email' => $this->email,
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
            'email' => $this->email,
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
        
        session()->flash('message', $this->patient_id ? 'Patient Updated Successfully.' : 'Patient Created Successfully.');
        $this->patient_id = $patient->id;
        $this->user_id = $user->id;
        $this->patient = Patient::find($this->patient_id);
        return true;
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
  
        $this->openCreateUpdate();
        $this->closeList();
    }
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function savePatientFile(){
        $this->validate([
            'file' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'], // 1MB Max
        ]);

        if (isset($this->file)) {
            $this->updatePatientFile($this->file);
            session()->flash('message','File updated successfully.');
        }
        $this->handleTabs('isOpenCondition', 'isOpenCreateTwo', 'editAssessment');
        return;

        // session()->flash('message','Error on uploading.');
    }

     /**
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

    public function updateAssessment(){
      $this->validate([
        'weight' => ['required', 'numeric'],
        'height' => ['required', 'numeric'],
        'blood_pressure' => 'required',
        'medical_condition' => 'required',        
      ]);

      $currentUser = Auth::user();

      return DB::transaction(function () use ($currentUser) {
        return tap(
          MedicalAssessment::updateOrCreate(['id' => $this->assessment_id],[
            'doctor_id' => $currentUser->hasRole('doctor') ? $currentUser->id : null,
            'nurse_id' => !$currentUser->hasRole('doctor') ? $currentUser->id : null,
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
            'active' => $this->active_assessment!=null ? intval($this->active_assessment) : 1,
          ]),
          function (MedicalAssessment $medicalAssessment) {
            if(!$this->assessment_id) {
              $patient = Patient::find($this->patient_id);
              $patient->medicalAssessment()->save($medicalAssessment);
              $this->assessment_id = $medicalAssessment->id;
            }
            $this->listHistory($this->patient_id);

            session()->flash('message', $this->patient_id ? 'Assessment Updated Successfully.' : 'Assessment Created Successfully.');
            return true;
          }
        );
      });
    }

    public function editAssessment()
    {
        $assessment = MedicalAssessment::where('patient_id', $this->patient_id)->where('active', 1)->first();
        if($assessment){
          $this->assessment_id = $assessment->id;        
          $this->weight = $assessment->weight;
          $this->height = $assessment->height;
          $this->temperature = $assessment->temperature;
          $this->blood_pressure = $assessment->blood_pressure;
          $this->medical_condition = $assessment->medical_condition;
          $this->medical_history = $assessment->medical_history;
          $this->alergic = $assessment->alergic;
          $this->alergies = $assessment->alergies;
          $this->medical_concerns = $assessment->medical_concerns;
          $this->diagnostic = $assessment->diagnostic;
          $this->treatment = $assessment->treatment;
          $this->active_assessment = $assessment->active_assessment;
        }
    }

    public function showHistories($id) {
      $this->edit($id);
      $this->resetComponent();
      $this->handleTabs('isOpenHistories', 'isOpenConditionTwo', $this->listHistory($id));
    }

    public function listHistory($id)
    {      
      $this->histories = MedicalAssessment::where('patient_id', $id)->get();
    }

    public function assessment($id) {
      $this->edit($id);
      $this->editAssessment();
      $this->resetComponent();
      $this->handleTabs('isOpenCondition', 'isOpenList');
    }

    public function showHistory($id)
    {      
      $historyToShow = MedicalAssessment::where('id', $id)->first();
      $timestamp = $historyToShow->created_at->timestamp;
      $historyToShow->date = date('d-m-Y', $timestamp);

      $doctor = Employee::find($historyToShow->doctor_id);
      if($doctor)
        $historyToShow->doctorName = $doctor->first_name. " " .$doctor->last_name;

      $nurse = Employee::find($historyToShow->nurse_id);
      if($nurse)
        $historyToShow->nurseName = $nurse->first_name. " " .$nurse->last_name;

      $this->historyToShow = $historyToShow;
      $this->handleTabs('isShowHistory', 'isOpenHistories');
    }
}