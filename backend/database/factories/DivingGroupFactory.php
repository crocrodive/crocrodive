<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DivingGroup>
 */
class DivingGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_user_id' => \App\Models\User::where("role_id", '=', 'Instructor' )->inRandomOrder()->first()->user_id,
            'sess_id' => \App\Models\Session::inRandomOrder()->first()->id
        ];
    }
}
