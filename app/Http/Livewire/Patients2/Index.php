<?php

namespace App\Http\Livewire\Patients2;

use App\Models\Patient;
use Livewire\Component;

use App\Models\MedicalAssessment;
use App\Models\Employee;
use Livewire\Redirect;
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

class Index extends Component
{
    public $patients, $last_name, $first_name, $id_number, $sex, $address, $email, $birthdate, $phone_number, $weight, $height, $eye_color;
    public $file, $photo, $search;
    public $patient_id, $user_id, $assessment_id;
    public $user, $patient, $patient_file_path, $histories, $historyToShow, $positionPage, $totalPatientHistories;
    public $assessment_type, $temperature, $blood_pressure, $medical_condition, $medical_history, $alergic, $alergies, $medical_concerns, $diagnostic, $treatment, $active_assessment = true;

    public $isOpenList = true;

    public function create()
    {
        return redirect()->route('patients-create');
    }

    public function render()
    {
        if ($this->search != '') {
            $this->patients = Patient::where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('id_number', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->patients = Patient::all();
        }

        return view('livewire.patients2.index');
    }

    /* EDIT/REDICT */
    public function irAComponenteB($id)
    {
        return redirect()->route('patient-edit', ['id' => $id]);
    }

    /* EDIT/REDICT */
    public function showHistories($id)
    {
        return redirect()->route('patient-histories', ['id' => $id, 'toShow' => 'histories']);
    }

    public function assessment($id)
    {
        return redirect()->route('patient-histories', ['id' => $id, 'toShow' => 'assessment']);
    }

    public function delete($id)
    {
        Patient::find($id)->delete();
        session()->flash('message', 'Patient Deleted Successfully.');
    }
    /* END EDIT */
}