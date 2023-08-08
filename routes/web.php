<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\IslandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(["middleware" => ["auth"]], function () {
    Route::get("/dashboard", function () {
        return view("dashboard.index");
    })->name("dashboard.index");

    Route::group(["middleware" => "role:admin"], function () {
        Route::get("/countries", [CountryController::class, "index"])->name("countries.index");

        Route::get("/islands", [IslandController::class, "index"])->name("islands.index");

        Route::get("/provinces", [ProvinceController::class, "index"])->name("provinces.index");

        Route::get("/cities", [CityController::class, "index"])->name("cities.index");

        Route::get("/users", [UserController::class, "index"])->name("users.index");
    });

    Route::group(["middleware" => "role:admin|sdm|pegawai"], function () {
        Route::get("/travels", [TravelController::class, "index"])->name("travels.index");
        Route::get("/travels/create", [TravelController::class, "create"])->name("travels.create");
        Route::post("/travels", [TravelController::class, "store"])->name("travels.store");
    });
});

require __DIR__ . '/auth.php';
