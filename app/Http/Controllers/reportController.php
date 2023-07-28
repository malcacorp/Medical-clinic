<?php
namespace App\Http\Controllers;
use App\View\Components;
use App\Models\MedicalAssessment;
use Illuminate\Http\Request;

class reportController extends Controller
{
   
    public function generarReporteSemanal()
    {
        $resultados = MedicalAssessment::select(DB::raw('YEARWEEK(created_at) AS semana, COUNT(DISTINCT patient_id) AS num_pacientes_atendidos'))
            ->groupBy('semana')
            ->get();

            dump($resultados);

        return view('reporteCarePeople', ['resultados' => $resultados]);
    }
    
}




