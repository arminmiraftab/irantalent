<?php

namespace Database\Seeders;

use App\Models\skill;
use App\Models\skill_user;
use App\Models\User;
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
        $this->call(UserTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(Skill_userTableSeeder::class);
        $this->call(SkillTableSeeder::class);

//
    }
}
