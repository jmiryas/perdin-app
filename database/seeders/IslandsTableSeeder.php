<?php

namespace Database\Seeders;

use App\Models\Island;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IslandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Island::create([
            "name" => "Pulau Sumatra",
        ]);

        Island::create([
            "name" => "Pulau Kalimantan",
        ]);

        Island::create([
            "name" => "Pulau Jawa",
        ]);

        Island::create([
            "name" => "Pulau Bali",
        ]);

        Island::create([
            "name" => "Pulau Nusa Tenggara",
        ]);

        Island::create([
            "name" => "Pulau Sulawesi",
        ]);

        Island::create([
            "name" => "Pulau Maluku",
        ]);

        Island::create([
            "name" => "Pulau Papua",
        ]);
    }
}
