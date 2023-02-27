<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class DepartamentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function index(){

        $departamentos = App\Models\Departamento::all();
        return view('departamento/index', compact('departamentos'));
    }

    public  function add(){

        return view('departamento/add');
    }

    public function save(Request $request){

        $nuevo = new App\Models\Departamento;
        $nuevo->nombre = $request->nombre;
        $nuevo->descripcion = $request->descripcion;
        $nuevo->estado = $request->estado;
        $nuevo -> save();
        return redirect('departamentos')->with('success', 'El Departamento Ha sido Creado con exito');   

    }
    public function delete(Request $request)
    {
        $nuevo =  App\Models\Departamento::findOrFail($request->id);
        $nuevo->delete();
        return redirect('departamentos')->with('success', 'El Departamento Ha sido Borrado con exito');   
    }

    public function edit($id){

        $item =  App\Models\Departamento::findOrFail($id);
        return view('departamento/edit', compact('item'));

    }

    public function update(Request $request, $id){

        $nuevo =  App\Models\Departamento::findOrFail($id);
        $nuevo->nombre = $request->nombre;
        $nuevo->descripcion = $request->descripcion;
        $nuevo->estado = $request->estado;
        $nuevo -> save();
        return redirect('departamentos')->with('success', 'El Departamento Ha sido Actualizado con exito');   
    }
}
