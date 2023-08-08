<?php

namespace Database\Seeders;

use App\Models\TravelStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TravelStatus::create([
            "name" => "Pending"
        ]);

        TravelStatus::create([
            "name" => "Accepted"
        ]);

        TravelStatus::create([
            "name" => "Rejected"
        ]);
    }
}
