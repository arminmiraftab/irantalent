<?php

namespace Database\Seeders;

use App\Models\country;
use App\Models\skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(99)->create();


    }
}
