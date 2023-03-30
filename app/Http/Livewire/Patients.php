<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Patient;

use App\Models\Team;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Livewire\WithFileUploads;
class Patients extends Component
{
    use WithFileUploads;

    public $patients, $last_name, $first_name, $id_number, $sex, $address, $email, $birthdate, $phone_number, $weight, $height, $eye_color;
    public $file, $photo;
    public $pressure, $temperature, $diagnostic, $treatment, $medical_condition;
    public $patient_id, $user_id;
    public $user, $patient, $patient_file_path;
    public $isOpenList = true;
    public $isOpenCreate = false;

    public $isOpenCreateTwo = false;
    public $isOpenCondition = false;
    public $isOpenConditionTwo = false;
    public $isOpenHistory = false;
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

        return DB::transaction(function () {
          return tap(
            User::updateOrCreate(['id' => $this->user_id],[
              'name' => $this->first_name . ' ' . $this->last_name,
              'email' => $this->email,
              'password' => Hash::make($this->id_number),
            ]),
            function (User $user) {
              $this->createTeam($user);

              if (isset($this->photo)) {
                  $user->updateProfilePhoto($this->photo);
              }

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
                  'user_id' => null,
                  ]);
              $user->patient()->save($patient);

              // $this->patient = $patient;
              $this->patient = Patient::find($this->patient_id);
              // $this->patient_id = $patient->id;
    
              session()->flash('message', $this->patient_id ? 'Patient Updated Successfully.' : 'Patient Created Successfully.');
              return true;
            }
          );
        });  
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
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

    public function savePatientFile($storagePath = 'files'){
        $this->validate([
            'file' => 'image|max:1024', // 1MB Max
        ]);

        if (isset($this->file)) {
            $this->updatePatientFile($this->file);
            session()->flash('message','File updated successfully.');
    
            $this->handleTabs('isOpenCondition', 'isOpenCreateTwo');
            return;
        }

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
}