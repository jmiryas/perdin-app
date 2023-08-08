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
}
