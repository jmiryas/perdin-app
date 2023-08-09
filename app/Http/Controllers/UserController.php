<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(["roles"])->orderBy("name")->get();

        return view("users.index", compact("users"));
    }

    public function create()
    {
        return view("users.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8"
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return redirect(route("admin.users.index"))->with("success", "Pengguna baru berhasil ditambahkan");
    }

    public function edit(User $user)
    {
        $selectedUser = User::with(["roles"])->where("id", $user->id)->first();

        $roles = Role::orderBy("name")->get();

        return view("users.edit", ["user" => $selectedUser, "roles" => $roles]);
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            "name" => "required",
            "email" => "required|email|unique:users,email," . $user->id,
            "role_id" => "required|exists:roles,id"
        ]);

        $selectedRole = Role::where("id", $request->role_id)->first();

        $user->update([
            "name" => $request->name,
            "email" => $request->email
        ]);

        $user->syncRoles([$selectedRole->name]);

        return redirect(route("admin.users.index"))->with("success", "Pengguna berhasil diedit");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route("admin.users.index"))->with("success", "Pengguna berhasil dihapus");
    }
}
