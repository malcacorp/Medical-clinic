<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colegio;
use App\Models\Estado;
use App\Models\EstadoCivil;
use App\Models\GrupoSanguineo;
use Illuminate\Support\Facades\Hash;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Etnia;
use App\Models\Religion;
use App;
use App\Models\User;
use App\Models\Patologia;
use App\Models\Prueba;
class DoctoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function index(){

        $doctores = App\Models\Persona::where('rol','MEDICO')->get();
        return view('doctores/index',compact('doctores'));
    }
    public function details($id){
        $doctor=  App\Models\Persona::findOrFail($id);
        return view('doctores/detalles', compact('doctor'));
    }

  

    public function add(){

            $paises = Pais::orderby('nombre','asc')->select('id','nombre')->get();
            $estados = Estado::orderby('nombre','asc')->select('id','nombre')->get();
            $grupoSanguineo = GrupoSanguineo::orderby('nombre','asc')->select('id','nombre')->get();
            $etnias = Etnia::orderby('nombre','asc')->select('id','nombre')->get();
            $religion = Religion::orderby('nombre','asc')->select('id','nombre')->get();
            $colegios = Colegio::orderby('nombre','asc')->select('id','nombre')->get();
            $estadocivil = EstadoCivil::orderby('nombre','asc')->select('id','nombre')->get();
            $paciente=new App\Models\Persona;
            $departamentos =  App\Models\Departamento::all();   
            return view('doctores/add', compact('departamentos','paciente','paises','estados','grupoSanguineo','etnias','religion','colegios','estadocivil'));
    }

    public function save(Request $request){
        
     
        $id= Persona::create($request->all());
  

        $relacion = new App\Models\Departamento_Persona;
     
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
        $id->rol="MEDICO";
        $id->save();

        $relacion->id_persona=$id->id;
        $relacion->id_departamento=$request->departamento;
        $relacion->especialidad=$request->especialidad;
        $relacion->save();

        User::create([
            'name' => $request->nombres,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_persona' => $id->id ,
        ]);
        
        return redirect('/doctores')->with('success','Medico Registrado con Exito');
    }

    


}
