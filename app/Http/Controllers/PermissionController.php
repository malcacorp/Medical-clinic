<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
      $permissions = Permission::select('id','name')->get()->paginate(2);
      return view('permissions.index', compact('permissions'));
      // return Inertia::render(''); $permissions;
    }
}
