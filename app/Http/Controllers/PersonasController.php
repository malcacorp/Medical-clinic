<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public  function registrar(){

        return view('registrar');
    }
}
