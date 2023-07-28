<?php

namespace App\Http\Livewire;
use App\Models\MedicalAssessment;
use App\Models\Employee;
use Livewire\Component;

class ReportDoctor extends Component
{
    public function render()
    {
        
        $atenciones = MedicalAssessment::join("employees","employees.id","=","doctor_id")
        ->select("first_name", "last_name")
        ->get();

        $atenciones2 = Employee::join("medical_assessments","medical_assessments.doctor_id","=","employees.id")
        ->select("doctor_id","patient_id","medical_condition", "medical_assessments.created_at" )
        ->get();
                
        return view('livewire.report.report-doctor', compact ('atenciones', "atenciones2"));
    }
}


