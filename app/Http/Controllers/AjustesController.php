<?php

namespace App\Http\Controllers;

use App\Models\Colegio;
use App\Models\Estado;
use App\Models\EstadoCivil;
use App\Models\GrupoSanguineo;
use Illuminate\Http\Request;

use App\Models\Persona;
use App\Models\Pais;
use App\Models\Etnia;
use App\Models\Religion;
use App;
use App\Models\Alergia;
use App\Models\Medicamento;
use App\Models\Patologia;
use App\Models\Patologia_persona;
use App\Models\Medicamento_persona;
use App\Models\Prueba;
use App\Models\Alergia_Persona;
use App\Models\Departamento;
use App\Models\inmunizacion;

class AjustesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function index(){

        $paises = Pais::orderby('nombre','asc')->select('id','nombre')->get();
        $estados = Estado::orderby('nombre','asc')->select('id','nombre')->get();
        $grupoSanguineo = GrupoSanguineo::orderby('nombre','asc')->select('id','nombre')->get();
        $etnias = Etnia::orderby('nombre','asc')->select('id','nombre')->get();
        $religion = Religion::orderby('nombre','asc')->select('id','nombre')->get();
        $colegios = Colegio::orderby('nombre','asc')->select('id','nombre')->get();
        $estadocivil = EstadoCivil::orderby('nombre','asc')->select('id','nombre')->get();
        $departamentos = Departamento::orderby('nombre','asc')->select('id','nombre')->get();
        $patologias = Patologia::orderby('nombre','asc')->select('id','nombre')->get();
        $pruebas = Prueba::orderby('nombre','asc')->select('id','nombre')->get();
        $medicamentos = Medicamento::orderby('nombre','asc')->select('id','nombre')->get();
        $alergias = Alergia::orderby('nombre','asc')->select('id','nombre')->get();
        $inmunizaciones = inmunizacion::orderby('nombre','asc')->select('id','nombre')->get();

        return view('ajustes/index', compact('paises','estados','grupoSanguineo','etnias','religion','colegios',
                                        'estadocivil','departamentos','patologias','pruebas',
                                        'medicamentos','alergias','inmunizaciones'));
    }
    public function patologiaAdd(){
        return view('ajustes/patologia');
    }
    public function patologiaEditar($id){
        $patologia = Patologia::findOrFail($id);
        return view('ajustes/patologia',compact('patologia'));
    }
    public function patologiaUpdate(Request $request, $id){
        $patologia = Patologia::findOrFail($id);
        $patologia->update($request->all());
        $patologia->save();
        return redirect('ajustes/patologias')->with('success','Patologia actualizada con exito');
    }
    public function patologiaSave(Request $request){
        $id= Patologia::create($request->all());
        return redirect('ajustes/patologias')->with('success','Patologia registrada con exito');
    }
    public function medicamentoAdd(){
        return view('ajustes/medicamento');
    }
    public function medicamentoEditar($id){
        $medicamento = Medicamento::findOrFail($id);
        return view('ajustes/medicamento',compact('medicamento'));
    }
    public function medicamentoUpdate(Request $request, $id){
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->nombre = $request->nombre;
        $medicamento->save();
        return redirect('ajustes/medicamentos')->with('success','Medicamento actualizada con exito');
    }
    public function medicamentoSave(Request $request){
        $id = Medicamento::create($request->all());
        return redirect('ajustes/medicamentos')->with('success','Medicamento registrada con exito');
    }
    public function alergiaAdd(){
        return view('ajustes/alergia');
    }
    public function alergiaEditar(Request $request, $id){
        $alergia = Alergia::findOrFail($id);
        return view('ajustes/alergia',compact('alergia'));
    }
    public function alergiaUpdate(Request $request, $id){
        $alergia = Alergia::findOrFail($id);
        $alergia->update($request->all());
        return redirect('ajustes/alergias')->with('success','Alergia actualizada con exito');
    }
    public function alergiaSave(Request $request){
        $id = Alergia::create($request->all());
        return redirect('ajustes/alergias')->with('success','Alergia registrada con exito');
    }
    public function pruebaAdd(){
        return view('ajustes/prueba');
    }
    public function pruebaEditar(Request $request, $id){
        $prueba = Prueba::findOrFail($id);
        return view('ajustes/prueba',compact('prueba'));
    }
    public function pruebaUpdate(Request $request, $id){
        $prueba = Prueba::findOrFail($id);
        $prueba->update($request->all());
        return redirect('ajustes/pruebas')->with('success','Examen Medico actualizado con exito');
    }
    public function pruebaSave(Request $request){
        $id = Prueba::create($request->all());
        return redirect('ajustes/pruebas')->with('success','Prueba registrada con exito');
    }
    public function inmunizacionAdd(){
        return view('ajustes/inmunizaciones');
    }
    public function inmunizacionSave(Request $request){
        $id = Inmunizacion::create($request->all());
        return redirect('ajustes/inmunizaciones')->with('success','Inmunizacion registrada con exito');
    }
    public function inmunizacionUpdate(Request $request, $id){
        $inmunizacion = Inmunizacion::findOrFail($id);
        $inmunizacion->update($request->all());
        return redirect('ajustes/inmunizaciones')->with('success','Inmunizacion actualizada con exito');
    }
    public function inmunizacionEditar(Request $request, $id){
        $inmunizacion = Inmunizacion::findOrFail($id);
        return view('ajustes/inmunizaciones',compact('inmunizacion'));
    }
}
