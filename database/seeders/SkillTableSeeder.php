<?php

namespace Database\Seeders;

use App\Models\skill;
use App\Models\skill_user;
use App\Models\User;
use Illuminate\Database\Seeder;

class SkillTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        skill::factory(100)->create();

//        User::factory()
//            ->has(skill::factory()->count(100))
//            ->create();
    }
}
