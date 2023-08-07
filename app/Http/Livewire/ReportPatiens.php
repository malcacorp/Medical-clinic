<?php

namespace App\Http\Livewire;
use App\Models\Patient;
use App\Models\MedicalAssessment;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class ReportPatiens extends Component
{
    public function render()
    {
        $reportpacients = Patient::all();
        return view('livewire.report.report-patiens', compact ('reportpacients'));
    }
}
