<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cour_id' => \App\Models\Course::inRandomOrder()->first()->id,
            'sess_date' => $this->faker->dateTimeThisYear('now'),
        ];
    }
}
