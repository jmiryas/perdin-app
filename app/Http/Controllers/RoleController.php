<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy("name")->get();

        return view("roles.index", compact("roles"));
    }

    public function create()
    {
        return view("roles.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|unique:roles,name"
        ]);

        Role::create(["name" => $request->name]);

        return redirect(route("admin.roles.index"))->with("success", "Role berhasil ditambahkan");
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect(route("admin.roles.index"))->with("success", "Role berhasil dihapus");
    }
}
