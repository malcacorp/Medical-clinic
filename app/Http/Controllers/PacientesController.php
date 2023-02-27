<?php

namespace App\Http\Controllers;

use App\Models\Colegio;
use App\Models\Estado;
use App\Models\EstadoCivil;
use App\Models\GrupoSanguineo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Etnia;
use App\Models\Religion;
use App;
use App\Models\User;
use App\Models\Alergia;
use App\Models\Medicamento;
use App\Models\Patologia;
use App\Models\Patologia_persona;
use App\Models\Medicamento_persona;
use App\Models\Prueba;
use App\Models\Alergia_Persona;
use App\Models\Persona_prueba;
use App\Models\inmunizacion;
use App\Models\Inmunizacion_Persona;

class PacientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function index(){

        $pacientes = App\Models\Persona::all();
        return view('pacientes/index',compact('pacientes'));
    }
    public function add(){

        $paises = Pais::orderby('nombre','asc')->select('id','nombre')->get();
        $estados = Estado::orderby('nombre','asc')->select('id','nombre')->get();
        $grupoSanguineo = GrupoSanguineo::orderby('nombre','asc')->select('id','nombre')->get();
        $etnias = Etnia::orderby('nombre','asc')->select('id','nombre')->get();
        $religion = Religion::orderby('nombre','asc')->select('id','nombre')->get();
        $colegios = Colegio::orderby('nombre','asc')->select('id','nombre')->get();
        $estadocivil = EstadoCivil::orderby('nombre','asc')->select('id','nombre')->get();

        return view('pacientes/add', compact('paises','estados','grupoSanguineo','etnias','religion','colegios','estadocivil'));
    }

    public function store(Request $request){

  

        $id= Persona::create($request->all());
  

        if ($request->hasFile('ruta_foto')) {
      
            $image = $request->file('ruta_foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $id->ruta_foto =  $name;
            $destinationPath = public_path('/imagenes/');
            $image->move($destinationPath, $name);
        }
        if ($request->hasFile('ruta_doc_identidad')) {
      
            $image = $request->file('ruta_doc_identidad');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $id->ruta_doc_identidad =  $name;
            $destinationPath = public_path('/imagenes/');
            $image->move($destinationPath, $name);
        }
        $id->save();
        User::create([
            'name' => $request->nombres,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            'id_persona' => $id->id ,
        ]);
        return redirect('/pacientes/registrar')->with('success','Persona Registrada con Exito');

    }

    public function edit($id){

        $paciente = App\Models\Persona::findOrFail($id);

        $paises = Pais::orderby('nombre','asc')->select('id','nombre')->get();
        $estados = Estado::orderby('nombre','asc')->select('id','nombre')->get();
        $grupoSanguineo = GrupoSanguineo::orderby('nombre','asc')->select('id','nombre')->get();
        $etnias = Etnia::orderby('nombre','asc')->select('id','nombre')->get();
        $religion = Religion::orderby('nombre','asc')->select('id','nombre')->get();
        $colegios = Colegio::orderby('nombre','asc')->select('id','nombre')->get();
        $estadocivil = EstadoCivil::orderby('nombre','asc')->select('id','nombre')->get();

        return view('pacientes/edit', compact('paciente','paises','estados','grupoSanguineo','etnias','religion','colegios','estadocivil'));


    }

    public function update(Request $request , $id){

  

        $paciente= Persona::findOrFail($id);
        $paciente->update($request->all());

        if ($request->hasFile('ruta_foto')) {
      
            $image = $request->file('ruta_foto');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $paciente->ruta_foto =  $name;
            $destinationPath = public_path('/imagenes/');
            $image->move($destinationPath, $name);
        }
        if ($request->hasFile('ruta_doc_identidad')) {
      
            $image = $request->file('ruta_doc_identidad');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $paciente->ruta_doc_identidad =  $name;
            $destinationPath = public_path('/imagenes/');
            $image->move($destinationPath, $name);
        }
        $paciente->save();
        return redirect('/pacientes')->with('success','Paciente actualizado con Exito');

    }
    public function historia(){

        $patologias = Patologia::orderby('nombre','asc')->select('id','nombre')->get();
        $pruebas = Prueba::orderby('nombre','asc')->select('id','nombre')->get();
        
        return view('pacientes/historia', compact('pruebas','patologias'));
    }

    public function delete(Request $request)
    {
        $nuevo =  App\Models\Departamento::findOrFail($request->id);
        $nuevo->delete();
        return redirect('departamentos')->with('success', 'El Departamento Ha sido Borrado con exito');   
    }

    public function details($id){
        $paciente = App\Models\Persona::findOrFail($id);
        return view('pacientes/detalles', compact('paciente'));
    }

    public function patologia($paciente){

        $patologias = Patologia::orderby('nombre','asc')->select('id','nombre')->get();

        return view('pacientes/patologia', compact('patologias','paciente'));
    }
    public function patologiaStore(Request $request){
        Patologia_persona::create($request->all());

        return redirect('/pacientes')->with('sucess','Patologia almacenada exitosamente');
    }
    public function medicamento($paciente){

        $medicamentos = Medicamento::orderby('nombre','asc')->select('id','nombre')->get();

        return view('pacientes/medicamento', compact('medicamentos','paciente'));
    }
    public function medicamentoStore(Request $request){
        Medicamento_persona::create($request->all());

        return redirect('/pacientes')->with('sucess','Medicamento almacenada exitosamente');
    }
    public function alergia($paciente){

        $alergias = Alergia::orderby('nombre','asc')->select('id','nombre')->get();

        return view('pacientes/alergia', compact('alergias','paciente'));
    }
    public function alergiaStore(Request $request){
        Alergia_Persona::create($request->all());

        return redirect('/pacientes')->with('sucess','Alergia almacenada exitosamente');
    }
    public function prueba($paciente){

        $pruebas = Prueba::orderby('nombre','asc')->select('id','nombre')->get();

        return view('pacientes/prueba', compact('pruebas','paciente'));
    }
    public function pruebaStore(Request $request){
        $paciente = persona_prueba::create($request->all());
        if ($request->hasFile('ruta_archivo')) {
      
            $image = $request->file('ruta_archivo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $paciente->ruta_archivo =  $name;
            $destinationPath = public_path('/imagenes/');
            $image->move($destinationPath, $name);
        }

        return redirect('/pacientes')->with('sucess','Alergia almacenada exitosamente');
    }
    public function antecedentesUpdate(Request $request , $id){

        $paciente = Persona::findOrFail($id);
        $paciente->Familiares = $request->antecedentes_familiares;
        $paciente->Patologicos = $request->antecedentes_patologicos;
        $paciente->ETS = $request->antecedentes_ETS;
        $paciente->Traumatologicos = $request->antecedentes_traumatologicos;
        $paciente->Transfusionales= $request->antecedentes_transfusionales;
        $paciente->save();
      
        return redirect('/pacientes/detalles/'.$id)->with('sucess','Antecedentes actualizados con exito');
        
    }
    public function inmunizacion($paciente){

        $inmunizaciones = inmunizacion::orderby('nombre','asc')->select('id','nombre')->get();

        return view('pacientes/inmunizacion', compact('inmunizaciones','paciente'));
    }
    public function inmunizacionStore(Request $request){
        Inmunizacion_Persona::create($request->all());

        return redirect('/pacientes')->with('sucess','Inmunizacion almacenada exitosamente');
    }
}
