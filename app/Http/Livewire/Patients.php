<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Patient;

use App\Models\Team;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class Patients extends Component
{
    public $patients, $last_name, $first_name, $id_number, $sex = 'Male', $address, $email, $birthdate, $phone_number, $weight, $height, $eye_color, $patient_id;
    public $isOpen = 0;
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
        $this->resetInputFields();
        $this->openModal();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
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
        $this->sex = 'Male';
        $this->patient_id = '';
        $this->email = '';
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
            'last_name' => 'required',
            'first_name' => 'required',
            'id_number' => ['required', Rule::unique('patients')->ignore($this->patient_id)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
   
        // Patient::updateOrCreate(['id' => $this->patient_id], [
        //     'last_name' => $this->last_name,
        //     'first_name' => $this->first_name
        // ]);

        return DB::transaction(function () {
          return tap(
            User::create([
              'name' => $this->first_name . ' ' . $this->last_name,
              'email' => $this->email,
              'password' => Hash::make($this->id_number),
            ]),
            function (User $user) {
              $this->createTeam($user);
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
              $user->patient()->save($patient);
    
              session()->flash('message', 
              $this->patient_id ? 'Patient Updated Successfully.' : 'Patient Created Successfully.');
    
              $this->closeModal();
              $this->resetInputFields();
            }
          );
        });

        // Patient::updateOrCreate(['id' => $this->patient_id], [
        //   'last_name' => $this->last_name,
        //   'first_name' => $this->first_name,
        //   'id_number' => $this->id_number,
        //   'sex' => $this->sex,
        //   'email' => $this->email,
        //   'phone_number' => $this->phone_number,
        //   'birthdate' => $this->birthdate,
        //   'weight' => $this->weight,
        //   'height' => $this->height,
        //   'eye_color' => $this->eye_color,
        //   'address' => $this->address,
        //   'user_id' => null,
        //   ]);
  
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
   
        $this->openModal();
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
}