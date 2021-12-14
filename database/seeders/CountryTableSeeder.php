<?php

namespace Database\Seeders;

use App\Models\country;
use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        country::factory(100)->create();

    }
}
