<?php

namespace Database\Seeders;

use App\Models\Island;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pemisahan provinsi Indonesia berdasarkan pulau

        $indonesiaIslands = [
            "Pulau Sumatra" => [
                "ACEH", "SUMATERA UTARA", "SUMATERA BARAT",
                "RIAU", "JAMBI", "SUMATERA SELATAN",
                "BENGKULU", "LAMPUNG", "KEPULAUAN BANGKA BELITUNG",
                "KEPULAUAN RIAU",
            ],
            "Pulau Jawa" => [
                "DKI JAKARTA", "JAWA BARAT", "JAWA TENGAH",
                "DI YOGYAKARTA", "JAWA TIMUR", "BANTEN"
            ],
            "Pulau Bali" => [
                "BALI"
            ],
            "Pulau Nusa Tenggara" => [
                "NUSA TENGGARA BARAT", "NUSA TENGGARA TIMUR"
            ],
            "Pulau Kalimantan" => [
                "KALIMANTAN TENGAH", "KALIMANTAN SELATAN",
                "KALIMANTAN TIMUR", "KALIMANTAN UTARA",
            ],
            "Pulau Sulawesi" => [
                "SULAWESI UTARA", "SULAWESI TENGAH", "SULAWESI SELATAN",
                "SULAWESI TENGGARA", "GORONTALO", "SULAWESI BARAT"
            ],
            "Pulau Maluku" => [
                "MALUKU", "MALUKU UTARA"
            ],
            "Pulau Papua" => [
                "PAPUA BARAT", "PAPUA"
            ]
        ];

        // Mendapatkan pulau-pulau dari database

        $islands = Island::get();

        $provincesJson = File::get(public_path("data/provinces.json"));
        $provinceList = json_decode($provincesJson);

        // Melakukan perulangan terhadap data provinsi json
        // Kemudian, lakukan perulangan pada $indonesiaIslands
        // untuk mengetahui suatu provinsi itu masuk ke dalam pulau apa
        // Contoh: Maluku => Pulau Maluku
        // Selanjutnya, lakukan perulangan pada $islands
        // untuk mengetahui id dari pulau di database
        // Terakhir, buat provinsi

        foreach ($provinceList as $provinceKey => $province) {
            foreach ($indonesiaIslands as $islandKey => $islandNames) {
                if (in_array($province->name, $islandNames)) {
                    foreach ($islands as $island) {
                        if ($islandKey == $island->name) {
                            Province::create([
                                "island_id" => $island->id,
                                "province_json_id" => $province->id,
                                "name" => $province->name,
                                "alt_name" => $province->alt_name,
                                "latitude" => $province->latitude,
                                "longitude" => $province->longitude,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
