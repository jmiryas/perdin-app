<?php

namespace Database\Seeders;

use App\Models\Travel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $travel1 = Travel::create([
            "div_sdm_id" => 2,
            "pegawai_id" => 4,
            "current_city_id" => 189,
            "destination_city_id" => 190,
            "country_id" => null,
            "travel_status_id" => 1,
            "description" => "Perjalanan dinas dari Banyumas ke Purbalingga",
            "start_date" => Carbon::parse("2023-06-08"),
            "end_date" => Carbon::parse("2023-06-11"),
            "allowance" => 0,
            "is_domestic" => true
        ]);

        $travel2 = Travel::create([
            "div_sdm_id" => 3,
            "pegawai_id" => 5,
            "current_city_id" => 189,
            "destination_city_id" => null,
            "country_id" => 196,
            "travel_status_id" => 1,
            "description" => "Perjalanan dinas dari Banyumas ke Singapura",
            "start_date" => Carbon::parse("2023-06-09"),
            "end_date" => Carbon::parse("2023-06-15"),
            "allowance" => 0,
            "is_domestic" => false
        ]);

        $travel3 = Travel::create([
            "div_sdm_id" => 3,
            "pegawai_id" => 4,
            "current_city_id" => 188,
            "destination_city_id" => null,
            "country_id" => 109,
            "travel_status_id" => 1,
            "description" => "Perjalanan dinas dari Cilacap ke Jepang",
            "start_date" => Carbon::parse("2023-06-12"),
            "end_date" => Carbon::parse("2023-06-20"),
            "allowance" => 0,
            "is_domestic" => false
        ]);

        $travel1->update([
            "travel_status_id" => 2
        ]);

        $travel2->update([
            "travel_status_id" => 3
        ]);

        $travel3->update([
            "travel_status_id" => 2
        ]);
    }
}
