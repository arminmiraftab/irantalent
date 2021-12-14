<?php

namespace Database\Factories;

use App\Models\skill_user;
use Illuminate\Database\Eloquent\Factories\Factory;

class Skill_userFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = skill_user::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'skill_id' => $this->faker->numberBetween(0, 100),
            'user_id' => $this->faker->numberBetween(0, 100),
            'level' => $this->faker->randomElement(['basic','intermediate', 'advance']),

        ];
    }
}
