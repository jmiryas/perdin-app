<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy("name")->get();

        // dd($roles);

        return view("roles.index", compact("roles"));
    }
}
