<?php

namespace App\Http\Livewire; 
use App\Models\MedicalAssessment;
use App\Models\Employee;
use Livewire\Component;

class ReportDoctor extends Component
{
    public function render()
    {       
        $medicalAssessments = MedicalAssessment::all();

        return view('livewire.report.report-doctor', compact ( "medicalAssessments"));
    }
}


