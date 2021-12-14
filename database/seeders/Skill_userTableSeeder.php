<?php

namespace Database\Seeders;

use App\Models\skill_user;
use Illuminate\Database\Seeder;

class Skill_userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        skill_user::factory(100)->create();

    }
}
