<?php
  
namespace App\Http\Livewire;
  
use Livewire\Component;
use App\Models\Employee;

use Illuminate\Validation\Rule;
  
class Employees extends Component
{
    public $employees, $id_number, $first_name, $last_name, $sex, $address, $email, $birthdate, $phone_number, $profession, $position, $speciality, $employee_id;
    public $employee, $photo;
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
            'email' => 'required',
            'phone_number' => 'required',
            'position' => 'required',
        ]);
   
        Employee::updateOrCreate(['id' => $this->employee_id], [
            'id_number' => $this->id_number,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birthdate' => $this->birthdate,
            'sex' => $this->sex,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'profession' => $this->profession,
            'position' => $this->position,
            'speciality' => $this->speciality,
        ]);
  
        session()->flash('message', 
            $this->employee_id ? 'Employee Updated Successfully.' : 'Employee Created Successfully.');
  
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
}