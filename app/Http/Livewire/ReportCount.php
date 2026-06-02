<?php

namespace App\Http\Livewire;
use App\Models\MedicalAssessment;
use App\Models\Employee;
use App\Models\Patient;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class ReportCount extends Component
{
        public function render()
        {
          $employee_Ney=DB::table('medical_assessments')
          ->where('employee_id', 5)
          ->count();
          $employee_Surmen = DB::table('medical_assessments')
          ->where('employee_id', 8)
          ->count();
          $employee_Luisa =DB::table('medical_assessments')
          ->where('employee_id', 3)
          ->count();
          

          $assessments = DB::table('medical_assessments')
          ->join('employees', 'medical_assessments.employee_id', '=', 'employees.id')
          ->select(DB::raw('YEAR(medical_assessments.created_at) as year'), 
                   DB::raw('WEEK(medical_assessments.created_at) as week'), 
                   'medical_assessments.employee_id', 
                   'employees.first_name', 
                   DB::raw('COUNT(medical_assessments.patient_id) as patient_count'))
          ->groupBy('year', 'week', 'medical_assessments.employee_id', 'employees.first_name')
          ->orderBy('year', 'desc')
          ->orderBy('week', 'desc')
          ->orderBy('medical_assessments.employee_id')
          ->get();
          return view('livewire.report.report-count', compact ('assessments','employee_Luisa','employee_Surmen','employee_Ney' ) );
        }

}