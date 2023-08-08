<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TravelStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // --- SEEDER PULAU, NEGARA, PROVINSI DAN KOTA START ---

        // Membuat seeder pulau-pulau di Indonesia
        // Sumber: https://www.detik.com/jabar/berita/d-6157370/daftar-lengkap-37-provinsi-di-indonesia-dan-nama-ibukotanya

        $this->call(IslandsTableSeeder::class);

        // Membuat seeder negara di seluruh dunia
        // Sumber: https://onlinewebtutorblog.com/wp-content/uploads/2021/08/countries-data.txt

        $this->call(CountriesTableSeeder::class);

        // Membuat seeder provinsi-provinsi di Indonesia
        // Sumber: https://raw.githubusercontent.com/yusufsyaifudin/wilayah-indonesia/master/data/list_of_area/provinces.json

        $this->call(ProvincesTableSeeder::class);

        // Membuat seeder kota-kota di Indonesia
        // Sumber: https://raw.githubusercontent.com/yusufsyaifudin/wilayah-indonesia/master/data/list_of_area/regencies.json

        $this->call(CitiesTableSeeder::class);

        // --- SEEDER PULAU, NEGARA, PROVINSI DAN KOTA END ---

        // --- SEEDER USER, ROLE DAN PERMISSION START ---

        $this->call(UsersTableSeeder::class);

        // --- SEEDER USER, ROLE DAN PERMISSION END ---

        // --- SEEDER TRAVEL STATUS START ---

        $this->call(TravelStatusesTableSeeder::class);

        $this->call(TravelsTableSeeder::class);

        // --- SEEDER TRAVEL STATUS END --- 
    }
}
