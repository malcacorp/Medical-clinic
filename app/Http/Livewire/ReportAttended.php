<?php

namespace App\Http\Livewire;
use App\Models\Patient;
use App\Models\MedicalAssessment;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ReportAttended extends Component
{
    
    public $patients;
    
    public function render()
    {
        $resultados = MedicalAssessment::all();
        return view('livewire.report.report-attended', compact ('resultados'));
     }

     
}
