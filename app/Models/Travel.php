<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $fillable = [
        "div_sdm_id", "pegawai_id", "current_city_id",
        "destination_city_id", "country_id", "travel_status_id",
        "start_date", "end_date", "allowance", "is_domestic", "description"
    ];

    protected $dates = ["start_date", "end_date"];

    public function divSDM()
    {
        return $this->belongsTo(User::class, "div_sdm_id", "id");
    }

    public function pegawai()
    {
        return $this->belongsTo(User::class, "pegawai_id", "id");
    }

    public function currentCity()
    {
        return $this->belongsTo(City::class, "current_city_id", "id");
    }

    public function destinationCity()
    {
        return $this->belongsTo(City::class, "destination_city_id", "id");
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function travelStatus()
    {
        return $this->belongsTo(TravelStatus::class);
    }

    public function travelDurationDays()
    {
        return $this->end_date->diffInDays($this->start_date);
    }

    public function getTitleCase($title)
    {
        return ucwords(strtolower($title));
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

    public function isSameProvince($currentCity, $destinationCity)
    {
        return $currentCity->province->name == $destinationCity->province->name ? "Ya" : "Tidak";
    }

    public function isSameIsland($currentCity, $destinationCity)
    {
        return $currentCity->province->island->name == $destinationCity->province->island->name ? "Ya" : "Tidak";
    }
}
