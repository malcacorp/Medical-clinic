<?php
  
namespace App\Http\Livewire;
  
use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use App\Models\Employee;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
  
class Employees extends Component
{
    use WithFileUploads;

    public $employees, $id_number, $first_name, $last_name, $sex, $address, $email, $birthdate, $phone_number, $profession, $position, $speciality;
    public $employee_id, $user_id;
    public $employee, $user, $photo;
    public $isOpenUpdate = 0, $isOpenList = 1;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        $this->employees = Employee::all();
        return view('livewire.employees.index');
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->handleTabs('isOpenUpdate','isOpenList');
        // $this->openUpdate();
    }

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
    public function openUpdate()
    {
        $this->isOpenUpdate = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeUpdate()
    {
        $this->isOpenUpdate = false;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->employee_id = '';
        $this->user_id = '';
        $this->id_number = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->birthdate = '';
        $this->sex = '';
        $this->email = '';
        $this->phone_number = '';
        $this->address = '';
        $this->profession = '';
        $this->position = '';
        $this->speciality = '';
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'id_number' => ['required', Rule::unique('employees')->ignore($this->employee_id)],
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
            'phone_number' => 'required',
            'position' => 'required',
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
   
        $employee = Employee::updateOrCreate(['id' => $this->employee_id], [
            'id_number' => $this->id_number,
            'first_name' => strtoupper($this->first_name),
            'last_name' => strtoupper($this->last_name),
            'birthdate' => $this->birthdate,
            'sex' => $this->sex,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => strtoupper($this->address),
            'profession' => strtoupper($this->profession),
            'position' => strtoupper($this->position),
            'speciality' => strtoupper($this->speciality),
            // 'user_id' => $user->id,
        ]);

        $user->employee()->save($employee);

        $roleEmployee = Role::where('name', 'standard')->first();
        $user->assignRole($roleEmployee);

        $this->user = $user;
        
        session()->flash('message', 
            $this->employee_id ? 'Employee Updated Successfully.' : 'Employee Created Successfully.');
        $this->employee_id = $employee->id;
        $this->user_id = $user->id;
        $this->employee = Employee::find($this->employee_id);
  
  
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
        $employee = Employee::findOrFail($id);
        $this->employee_id = $id;
        $this->user_id = $employee->user_id;
        $this->id_number = $employee->id_number;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->birthdate = $employee->birthdate;
        $this->sex = $employee->sex;
        $this->email = $employee->email;
        $this->phone_number = $employee->phone_number;
        $this->address = $employee->address;
        $this->profession = $employee->profession;
        $this->position = $employee->position;
        $this->speciality = $employee->speciality;

        $this->user = User::find($this->user_id);
        $this->employee = Employee::find($id);

  
        $this->handleTabs('isOpenUpdate','isOpenList');
    }
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Employee::find($id)->delete();
        session()->flash('message', 'Employee Deleted Successfully.');
    }

    protected function createTeam(User $user): void
    {
      $user->ownedTeams()->save(Team::forceCreate([
        'user_id' => $user->id,
        'name' => explode(' ', $user->name, 2)[0] . "'s Team",
        'personal_team' => true,
      ]));
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