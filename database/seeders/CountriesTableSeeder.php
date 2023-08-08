<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countriesJson = File::get(public_path("data/countries.json"));
        $countryList = json_decode($countriesJson);

        foreach ($countryList->countries as $key => $value) {
            Country::create([
                "name" => $value->name,
                "sortname" => $value->sortname,
            ]);
        }
    }
}
