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
    return view('welcome');
});

Route::group(["middleware" => ["auth"]], function () {
    Route::get("/dashboard", function () {
        return view("dashboard.index");
    })->name("dashboard.index");

    Route::group(["middleware" => "role:admin", "prefix" => "admin"], function () {
        Route::get("/countries", [CountryController::class, "index"])->name("admin.countries.index");

        Route::get("/islands", [IslandController::class, "index"])->name("admin.islands.index");

        Route::get("/provinces", [ProvinceController::class, "index"])->name("admin.provinces.index");

        Route::get("/cities", [CityController::class, "index"])->name("admin.cities.index");

        Route::get("/roles", [RoleController::class, "index"])->name("admin.roles.index");

        Route::get("/users", [UserController::class, "index"])->name("admin.users.index");

        Route::get("/travels", [AdminTravelController::class, "index"])->name("admin.travels.index");
        Route::get("/travels/create", [AdminTravelController::class, "create"])->name("admin.travels.create");
        Route::post("/travels", [AdminTravelController::class, "store"])->name("admin.travels.store");
        Route::get("/travels/{travel}", [AdminTravelController::class, "show"])->name("admin.travels.show");
        Route::post("/travels/reject", [AdminTravelController::class, "rejectTravel"])->name("admin.travels.reject");
        Route::post("/travels/accept", [AdminTravelController::class, "acceptTravel"])->name("admin.travels.accept");
        Route::delete("/travels/{travel}", [AdminTravelController::class, "destroy"])->name("admin.travels.destroy");
    });

    Route::group(["middleware" => "role:sdm", "prefix" => "sdm"], function () {
        Route::get("/travels", [SdmTravelController::class, "index"])->name("sdm.travels.index");
        Route::get("/travels/histories", [SdmTravelController::class, "travelHistories"])->name("sdm.travels.histories");
        Route::get("/travels/{travel}", [SdmTravelController::class, "show"])->name("sdm.travels.show");
        Route::post("/travels/reject", [SdmTravelController::class, "rejectTravel"])->name("sdm.travels.reject");
        Route::post("/travels/accept", [SdmTravelController::class, "acceptTravel"])->name("sdm.travels.accept");
    });

    Route::group(["middleware" => "role:pegawai"], function () {
        Route::get("/travels", [TravelController::class, "index"])->name("travels.index");
        Route::get("/travels/create", [TravelController::class, "create"])->name("travels.create");
        Route::post("/travels", [TravelController::class, "store"])->name("travels.store");
    });
});

require __DIR__ . '/auth.php';
