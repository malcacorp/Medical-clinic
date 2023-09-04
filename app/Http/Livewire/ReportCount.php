<?php

namespace App\Http\Livewire;
use App\Models\Patient;
use App\Models\MedicalAssessment;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ReportCount extends Component
{
      public function render()
        {
        $assessments = DB::table('medical_assessments')
        ->select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('COUNT(*) as patient_count'))
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('WEEK(created_at)'))
        ->orderBy(DB::raw('YEAR(created_at)'), 'desc')
        ->orderBy(DB::raw('WEEK(created_at)'), 'desc')
        ->get();
        
        return view('livewire.report.report-count', compact ('assessments'));
    }
}