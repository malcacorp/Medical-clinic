<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Patient;
class Patients extends Component
{
    public $patients, $last_name, $first_name, $email, $birthdate, $phone_number, $weight, $height, $eye_color, $patient_id;
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
        $this->patient_id = '';
        $this->email = '';
        $this->phone_number = '';
        $this->birthdate = '';
        $this->weight = '';
        $this->height = '';
        $this->eye_color = '';
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
        ]);
   
        // Patient::updateOrCreate(['id' => $this->patient_id], [
        //     'last_name' => $this->last_name,
        //     'first_name' => $this->first_name
        // ]);

        Patient::updateOrCreate(['id' => $this->patient_id], [
              'last_name' => $this->last_name,
              'first_name' => $this->first_name,
              'email' => $this->email,
              'phone_number' => $this->phone_number,
              'birthdate' => $this->birthdate,
              'weight' => $this->weight,
              'height' => $this->height,
              'eye_color' => $this->eye_color,
          ]);
  
        session()->flash('message', 
            $this->patient_id ? 'Patient Updated Successfully.' : 'Patient Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
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
        $this->email = $patient->email;
        $this->phone_number = $patient->phone_number;
        $this->birthdate = $patient->birthdate;
        $this->weight = $patient->weight;
        $this->height = $patient->height;
        $this->eye_color = $patient->eye_color;
    
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
}