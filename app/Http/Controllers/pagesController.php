<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class pagesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $citas = App\Models\Cita::all();
        return view('home',compact('citas'));
    }
    public function home()
    {
        $citas = App\Models\Cita::all();
        return view('home',compact('citas'));
    }
}
