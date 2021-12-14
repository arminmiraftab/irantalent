<?php

namespace Database\Factories;

use App\Models\skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class skillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = skill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),

        ];
    }
}
