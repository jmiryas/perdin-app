<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Travel;
use App\Models\TravelStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminTravelController extends Controller
{
    public function index()
    {
        $travels = Travel::with(["travelStatus", "currentCity", "destinationCity"])->orderBy("travel_status_id")->get();

        return view("admin_travels.index", compact("travels"));
    }

    public function create()
    {
        $cities = City::orderBy("province_id")->orderBy("name")->get();

        $users_sdm = $users = User::role("sdm")->get();
        $users_pegawai = $users = User::role("pegawai")->get();

        return view("admin_travels.create", compact("cities", "users_sdm", "users_pegawai"));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "div_sdm_id" => "required|exists:users,id",
            "pegawai_id" => "required|exists:users,id",
            "current_city_id" => "required|exists:cities,id",
            "destination_city_id" => "required|exists:cities,id",
            "start_date" => "required|date|before:end_date",
            "end_date" => "required|date|after:start_date",
            "description" => ""
        ]);

        $user_div_sdm = User::where("id", $request->div_sdm_id)->first();
        $user_pegawai = User::where("id", $request->pegawai_id)->first();

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
                "pegawai_id" => $user_pegawai->id,
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
            // Tidak perlu mencari provinsi dan pulau karena 
            // perjalanannya ke luar negeri

            $allowance = $this->getAllowance($duration, $distance, false, false, false);

            Travel::create([
                "div_sdm_id" => $user_div_sdm->id,
                "pegawai_id" => $user_pegawai->id,
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

        return redirect(route("admin.travels.index"))->with("success", "Perjalanan dinas berhasil dibuat");
    }

    public function show(Travel $travel)
    {
        return view("admin_travels.show", ["travel" => $travel]);
    }

    public function rejectTravel(Request $request)
    {
        $this->validate($request, [
            "travel_id" => "required|exists:travel,id"
        ]);

        $travel = Travel::where("id", $request->travel_id)->first();

        $travel_status_rejected = TravelStatus::where("name", "Rejected")->first();

        $travel->update([
            "travel_status_id" => $travel_status_rejected->id
        ]);

        return redirect(route("admin.travels.index"))->with("success", "Perdin berhasil ditolak");
    }

    public function acceptTravel(Request $request)
    {
        $this->validate($request, [
            "travel_id" => "required|exists:travel,id"
        ]);

        $travel = Travel::where("id", $request->travel_id)->first();

        $travel_status_accepted = TravelStatus::where("name", "Accepted")->first();

        $travel->update([
            "travel_status_id" => $travel_status_accepted->id
        ]);

        return redirect(route("admin.travels.index"))->with("success", "Perdin berhasil disetujui");
    }

    public function destroy(Travel $travel)
    {
        $travel->delete();

        return redirect(route("admin.travels.index"))->with("success", "Perdin berhasil dihapus");
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
