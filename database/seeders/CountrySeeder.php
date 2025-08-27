<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch a list of countries from a public API
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,cca2');
        $countries = $response->json();

        if ($countries) {
            foreach ($countries as $country) {
                Country::firstOrCreate(
                    ['code' => $country['cca2']],
                    ['name' => $country['name']['common']]
                );
            }
        }
    }
}
