<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manager_user_id' => \App\Models\User::where("role_id", '=', 'Course Manager' )->inRandomOrder()->first()->user_id,
            'leve_id' => \App\Models\Level::inRandomOrder()->first()->id,
            'site_id' => \App\Models\Site::inRandomOrder()->first()->id,
            'cour_start_date' => $this->faker->date(),
        ];
    }
}
