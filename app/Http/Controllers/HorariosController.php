<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Models\Persona;

class HorariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function index(){

        return view('horarios/index');
    }

    public function add(){
        $doctores = Persona::where('rol','MEDICO')->orderby('nombres','asc')->select('id','nombres')->get();

        return view('horarios/add', compact('doctores'));
    }

    public function save(Request $request){


    }
}
