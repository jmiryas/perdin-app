<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data kota di Indonesia

        $provinces = Province::get();

        $citiesJson = File::get(public_path("data/regencies.json"));
        $cityList = json_decode($citiesJson);

        $countryID = Country::where("name", "Indonesia")->first();

        // Melakukan perulangan terhadap data regencies.json
        // Kemudian, lakukan perulangan terhadap kota-kota
        // yang ada di database
        // Jika id dari province_json_id sama dengan province_id pada data regencies.json
        // Maka, buat City
        // Ini dilakukan karena data id di database berbeda dengan data id dari json

        foreach ($provinces as $province) {
            foreach ($cityList as $key => $value) {
                if ($province->province_json_id == $value->province_id) {
                    City::create([
                        "province_id" => $province->id,
                        "country_id" => $countryID->id,
                        "name" => $value->name,
                        "alt_name" => $value->alt_name,
                        "latitude" => $value->latitude,
                        "longitude" => $value->longitude,
                    ]);
                }
            }
        }

        // Menambahkan data kota di dunia
        // beserta negaranya

        $world_citiesJson = File::get(public_path("data/word_cities.json"));
        $world_cityList = json_decode($world_citiesJson);

        $countries = Country::all();

        for ($index = 0; $index < 500; $index++) {
            if ($world_cityList[$index]->country != "Indonesia") {
                foreach ($countries as $country) {
                    if ($country->sortname == $world_cityList[$index]->iso2) {
                        City::create([
                            "province_id" => null,
                            "country_id" => $country->id,
                            "name" => $world_cityList[$index]->city,
                            "alt_name" => $world_cityList[$index]->admin_name,
                            "latitude" => $world_cityList[$index]->lat,
                            "longitude" => $world_cityList[$index]->lng,
                        ]);
                    }
                }
            }
        }
    }
}
