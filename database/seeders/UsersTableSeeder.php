<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id: 1

        $userAdmin = User::create([
            "name" => "Homelander",
            "email" => "homelander@gmail.com",
            "password" => Hash::make("user123")
        ]);

        // id: 2

        $userSDM = User::create([
            "name" => "Annie January",
            "email" => "annie@gmail.com",
            "password" => Hash::make("user123")
        ]);

        // id: 3

        $userSDM2 = User::create([
            "name" => "Queen Maeve",
            "email" => "queen@gmail.com",
            "password" => Hash::make("user123")
        ]);

        // id: 4

        $userPegawai = User::create([
            "name" => "Hughie Campbell",
            "email" => "hughie@gmail.com",
            "password" => Hash::make("user123")
        ]);

        // id: 5

        $userPegawai2 = User::create([
            "name" => "Billy Butcher",
            "email" => "billy@gmail.com",
            "password" => Hash::make("user123")
        ]);

        $roleAdmin = Role::create(["name" => "admin"]);
        $roleSDM = Role::create(["name" => "sdm"]);
        $rolePegawai = Role::create(["name" => "pegawai"]);

        // Admin permissions

        Permission::create(["name" => "read users"]);
        Permission::create(["name" => "create users"]);
        Permission::create(["name" => "edit users"]);
        Permission::create(["name" => "delete users"]);

        Permission::create(["name" => "read role"]);
        Permission::create(["name" => "create role"]);
        Permission::create(["name" => "edit role"]);
        Permission::create(["name" => "delete role"]);

        Permission::create(["name" => "read islands"]);
        Permission::create(["name" => "create islands"]);
        Permission::create(["name" => "edit islands"]);
        Permission::create(["name" => "delete islands"]);

        Permission::create(["name" => "read countries"]);
        Permission::create(["name" => "create countries"]);
        Permission::create(["name" => "edit countries"]);
        Permission::create(["name" => "delete countries"]);

        Permission::create(["name" => "read provinces"]);
        Permission::create(["name" => "create provinces"]);
        Permission::create(["name" => "edit provinces"]);
        Permission::create(["name" => "delete provinces"]);

        Permission::create(["name" => "read cities"]);
        Permission::create(["name" => "create cities"]);
        Permission::create(["name" => "edit cities"]);
        Permission::create(["name" => "delete cities"]);

        Permission::create(["name" => "read travels"]);
        Permission::create(["name" => "create travels"]);
        Permission::create(["name" => "edit travels"]);
        Permission::create(["name" => "delete travels"]);

        $userAdmin->assignRole("admin");

        $userSDM->assignRole("sdm");
        $userSDM2->assignRole("sdm");

        $userPegawai->assignRole("pegawai");
        $userPegawai2->assignRole("pegawai");

        // Menambahkan admin permissions

        $roleAdmin->givePermissionTo(["read users", "create users", "edit users", "delete users"]);
        $roleAdmin->givePermissionTo(["read role", "create role", "edit role", "delete role"]);
        $roleAdmin->givePermissionTo(["read islands", "create islands", "edit islands", "delete islands"]);
        $roleAdmin->givePermissionTo(["read countries", "create countries", "edit countries", "delete countries"]);
        $roleAdmin->givePermissionTo(["read provinces", "create provinces", "edit provinces", "delete provinces"]);
        $roleAdmin->givePermissionTo(["read cities", "create cities", "edit cities", "delete cities"]);
        $roleAdmin->givePermissionTo(["read travels", "create travels", "edit travels", "delete travels"]);

        $roleSDM->givePermissionTo(["read travels", "edit travels"]);

        $roleAdmin->givePermissionTo(["read travels", "create travels"]);
    }
}
