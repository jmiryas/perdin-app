<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Travel;
use App\Models\TravelStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentRoles = auth()->user()->getRoleNames();

        $travels = Travel::with(["travelStatus", "currentCity", "destinationCity", "country"])->orderBy("travel_status_id")->get();

        $filtered_travels = collect();

        if (empty(array_diff($currentRoles->toArray(), ["admin"]))) {
            $filtered_travels = $travels;
        } else if (empty(array_diff($currentRoles->toArray(), ["sdm"]))) {
            $filtered_travels = $travels->filter(function ($item) {
                return $item->div_sdm_id == auth()->user()->id;
            })->values();
        } else if (empty(array_diff($currentRoles->toArray(), ["pegawai"]))) {
            $filtered_travels = $travels->filter(function ($item) {
                return $item->pegawai_id == auth()->user()->id;
            })->values();
        }

        return view("travels.index", compact("filtered_travels"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderBy("province_id")->orderBy("name")->get();

        return view("travels.create", compact("cities"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "current_city_id" => "required|exists:cities,id",
            "destination_city_id" => "required|exists:cities,id",
            "start_date" => "required|date|before:end_date",
            "end_date" => "required|date|after:start_date",
            "description" => ""
        ]);

        $user_div_sdm = User::role("sdm")->first();

        $travel_status = TravelStatus::where("name", "Pending")->first();

        $current_city = City::with(["province"])->where("id", $request->current_city_id)->first();
        $destination_city = City::with(["province"])->where("id", $request->destination_city_id)->first();

        $duration = Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date));

        $distance = $this->getDistance($current_city->latitude, $current_city->longitude, $destination_city->latitude, $destination_city->longitude);

        // Jika berasal dari negara yang sama
        // Maka, cari provinsi dan pulaunya
        // Selain itu buat travel ke luar negeri

        if ($current_city->country->name == $destination_city->country->name) {
            $isSameProvince = $current_city->province->name == $destination_city->province->name;

            $isSameIsland = $current_city->province->island->name == $destination_city->province->island->name;

            $allowance = $this->getAllowance($duration, $distance, $isSameProvince, $isSameIsland, true);

            Travel::create([
                "div_sdm_id" => $user_div_sdm->id,
                "pegawai_id" => auth()->user()->id,
                "current_city_id" => $current_city->id,
                "destination_city_id" => $destination_city->id,
                "travel_status_id" => $travel_status->id,
                "description" => $request->description,
                "start_date" => Carbon::parse($request->start_date),
                "end_date" => Carbon::parse($request->end_date),
                "allowance" => $allowance,
                "is_domestic" => true,
            ]);
        } else {
            $allowance = $this->getAllowance($duration, $distance, false, false, false);

            Travel::create([
                "div_sdm_id" => $user_div_sdm->id,
                "pegawai_id" => auth()->user()->id,
                "current_city_id" => $current_city->id,
                "destination_city_id" => $destination_city->id,
                "travel_status_id" => $travel_status->id,
                "description" => $request->description,
                "start_date" => Carbon::parse($request->start_date),
                "end_date" => Carbon::parse($request->end_date),
                "allowance" => $allowance,
                "is_domestic" => false,
            ]);
        }

        return redirect(route("travels.index"))->with("success", "Perjalanan dinas berhasil dibuat");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function edit(Travel $travel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        //
    }

    // Menghitung jarak berdasarkan lat dan long
    // Sumber: https://www.geodatasource.com/resources/tutorials/how-to-calculate-the-distance-between-2-locations-using-php/#:~:text=php%20function%20distance(%24lat1,(%24dist)%3B%20%24miles%20%3D%20%24
    // Pengecekan: https://www.meridianoutpost.com/resources/etools/calculators/calculator-latitude-longitude-distance.php?

    function getDistance($lat1, $lon1, $lat2, $lon2)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            return ($miles * 1.609344);
        }
    }

    // Menghitung uang saku selama perjalanan

    function getAllowance($duration, $distance, $isSameProvince, $isSameIsland, $isDomestic)
    {
        if ($isDomestic) {
            if ($distance <= 60) {
                // Jika jarak kurang dari 60km
                // Maka, tidak mendapat uang saku

                return 0;
            } else if ($distance > 60 && $isSameProvince && $isSameIsland) {
                // Jika jarak lebih dari 60km
                // Tapi dalam satu provinsi dan satu pulau
                // Maka, mendapatkan Rp 200.000 / hari

                return $duration * 200000;
            } else if ($distance > 60 && !$isSameProvince && $isSameIsland) {
                // Jika jarak lebih dari 60km
                // Tapi dalam keluar provinsi dan satu pulau
                // Maka, mendapatkan Rp 250.000 / hari

                return $duration * 250000;
            } else {
                // Jika jarak lebih dari 60km
                // Tapi dalam keluar provinsi dan keluar pulau
                // Maka, mendapatkan Rp 250.000 / hari

                return $duration * 300000;
            }
        } else {
            // Jika ke luar negeri
            // Maka mendapatkan uang saku
            // USD 50 (dalam dollar bukan rupiah) / hari

            return $duration * 50;
        }
    }
}
