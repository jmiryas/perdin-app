<?php

namespace Database\Seeders;

use App\Models\City;
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
        $provinces = Province::get();

        $citiesJson = File::get(public_path("data/regencies.json"));
        $cityList = json_decode($citiesJson);

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
                        "name" => $value->name,
                        "alt_name" => $value->alt_name,
                        "latitude" => $value->latitude,
                        "longitude" => $value->longitude,
                    ]);
                }
            }
        }
    }
}
