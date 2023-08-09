<?php

use App\Http\Controllers\AdminTravelController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\IslandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SdmTravelController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view("landing");
})->name("landing.index");

Route::group(["middleware" => ["auth"]], function () {
    // Dashboard ketika login

    Route::get("/dashboard", function () {
        return view("dashboard.index");
    })->name("dashboard.index");

    // Menu Admin

    Route::group(["middleware" => "role:admin", "prefix" => "admin"], function () {
        Route::get("/countries", [CountryController::class, "index"])->name("admin.countries.index");

        Route::get("/islands", [IslandController::class, "index"])->name("admin.islands.index");

        Route::get("/provinces", [ProvinceController::class, "index"])->name("admin.provinces.index");

        Route::get("/cities", [CityController::class, "index"])->name("admin.cities.index");

        Route::get("/roles", [RoleController::class, "index"])->name("admin.roles.index");
        Route::get("/roles/create", [RoleController::class, "create"])->name("admin.roles.create");
        Route::post("/roles", [RoleController::class, "store"])->name("admin.roles.store");
        Route::delete("/roles/{role}", [RoleController::class, "destroy"])->name("admin.roles.destroy");

        Route::get("/users", [UserController::class, "index"])->name("admin.users.index");
        Route::get("/users/create", [UserController::class, "create"])->name("admin.users.create");
        Route::get("/users/edit/{user}", [UserController::class, "edit"])->name("admin.users.edit");
        Route::put("/users/{user}", [UserController::class, "update"])->name("admin.users.update");
        Route::post("/users", [UserController::class, "store"])->name("admin.users.store");
        Route::delete("/users/{user}", [UserController::class, "destroy"])->name("admin.users.destroy");

        Route::get("/travels", [AdminTravelController::class, "index"])->name("admin.travels.index");
        Route::get("/travels/create", [AdminTravelController::class, "create"])->name("admin.travels.create");
        Route::post("/travels", [AdminTravelController::class, "store"])->name("admin.travels.store");
        Route::get("/travels/{travel}", [AdminTravelController::class, "show"])->name("admin.travels.show");
        Route::post("/travels/reject", [AdminTravelController::class, "rejectTravel"])->name("admin.travels.reject");
        Route::post("/travels/accept", [AdminTravelController::class, "acceptTravel"])->name("admin.travels.accept");
        Route::delete("/travels/{travel}", [AdminTravelController::class, "destroy"])->name("admin.travels.destroy");
    });

    // Menu SDM

    Route::group(["middleware" => "role:sdm", "prefix" => "sdm"], function () {
        Route::get("/travels", [SdmTravelController::class, "index"])->name("sdm.travels.index");
        Route::get("/travels/histories", [SdmTravelController::class, "travelHistories"])->name("sdm.travels.histories");
        Route::get("/travels/{travel}", [SdmTravelController::class, "show"])->name("sdm.travels.show");
        Route::post("/travels/reject", [SdmTravelController::class, "rejectTravel"])->name("sdm.travels.reject");
        Route::post("/travels/accept", [SdmTravelController::class, "acceptTravel"])->name("sdm.travels.accept");
    });

    // Menu Pegawai

    Route::group(["middleware" => "role:pegawai"], function () {
        Route::get("/travels", [TravelController::class, "index"])->name("travels.index");
        Route::get("/travels/create", [TravelController::class, "create"])->name("travels.create");
        Route::post("/travels", [TravelController::class, "store"])->name("travels.store");
    });
});

Route::fallback(function () {
    return redirect(route("landing.index"));
});

require __DIR__ . '/auth.php';
