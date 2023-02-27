<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models\Departamento;
use App\Models\Persona;
use App\Models\Cita;
use App\Models\Habito;
use App\Models\Consulta; 
use App\Models\AntecedentesFamiliares;

class CitasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function index(){
        $citas = Cita::orderby('id','asc')->get();
        return view('citas/index',compact('citas'));
    }
    public  function add($id = null){
        $aux =  App\Models\Cita::latest('id')->first();
       
        if(!$aux){
            $next=0;
        }else{
            $next= $aux->id + 1 ;
        }

        $pacientes = Persona::orderby('nombres','asc')->select('id','nombres')->get();
        $doctores = Persona::where('rol','MEDICO')->orderby('nombres','asc')->select('id','nombres')->get();
        $departamentos = Departamento::orderby('nombre','asc')->select('id','nombre')->get();
       
        return view('citas/add',compact('next','pacientes','doctores','departamentos','id'));
    }

    public function consulta($cita){
        $appoint = Cita::find($cita);
        $paciente = Persona::find($appoint->paciente_id);
        $habito = Habito::where('id_persona',$appoint->paciente_id)->get();
        $antecedente = AntecedentesFamiliares::where('id_persona',$appoint->paciente_id)->get();
        return view('citas/consulta', compact('habito','antecedente','cita','paciente'));
    }

    public function consultaAdd(Request $request, $cita){
        $appoint = Cita::find($cita);
        $paciente = Persona::find($appoint->paciente_id);
        $habito = Habito::where('id_persona',$paciente->id);
        if (isset($habito->id)){
            $habito = $habito->id;
        }else{
            $habito = null;
        }
        $antecedente = AntecedentesFamiliares::where('id_persona',$paciente->id);
        if (isset($antecedente->id)){
            $antecedente = $antecedente->id;
        }else{
            $antecedente = null;
        }
        Consulta::create([
            'paciente_id' => $paciente->id,
            'id_cita' => $cita,
            "motivo" => $request->motivo,
            'EA' => $request->EA,
            'condiciones' => $request->condiciones,
            'peso' => $request->peso,
            'talla' => $request->talla,
            'imc' => $request->imc,
            'TA' => $request->TA,
            'FC' => $request->FC,
            'FR' => $request->FR
        ]);
        
        if (isset($habito)){
            Habito::updateOrCreate($habito->id,
        [
            'id_persona' => $paciente->id,
            'tbq_bool' => $request->tbq_bool,
            'tbq_det' => $request->tbq_det,
            'alc_bool' => $request->alc_bool,
            'alc_det' => $request->alc_det,
            'drg_bool' => $request->drg_bool,
            'drg_det' => $request->drg_det,
            'sex' => $request->sex,
            'nut' => $request->nut,
        ]);
        }else{
            Habito::create([
                'id_persona' => $paciente->id,
                'tbq_bool' => $request->tbq_bool,
                'tbq_det' => $request->tbq_det,
                'alc_bool' => $request->alc_bool,
                'alc_det' => $request->alc_det,
                'drg_bool' => $request->drg_bool,
                'drg_det' => $request->drg_det,
                'sex' => $request->sex,
                'nut' => $request->nut,
            ]);
        }

        if (isset($antecedente->id)){
            AntecedentesFamiliares::updateOrCreate($antecedente->id,
        [
            'id_persona' => $paciente->id,
            'madre' => $request->madre,
            'padre' => $request->padre,
            'hermanos' => $request->hermanos,
            'hijos' => $request->hijos
        ]);
        }else{
            
        AntecedentesFamiliares::create([
            'id_persona' => $paciente->id,
            'madre' => $request->madre,
            'padre' => $request->padre,
            'hermanos' => $request->hermanos,
            'hijos' => $request->hijos
        ]);

        }
        
        return redirect('citas')->with('success','Consulta actualizada con exito');
    }

    public function save(Request $request){
        $id = Cita::create($request->all());
        return redirect('citas/crear')->with('success','Cita registrada satisfactoriamente');
    }
    public function delete(Request $request){
        
    }
    public function update(Request $request, $id){
        $cita = Cita::findOrFail($id);
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->notas = $request->notas;
        $cita->estado = $request->estado;
        $cita->save();
        return redirect('citas')->with('success','Cita actualizada con exito');
    }
    public function edit($id){
        $cita = Cita::findOrFail($id);
        return view('citas/edit', compact('cita'));
    }
}
