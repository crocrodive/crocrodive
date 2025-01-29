<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->user_id,
            'abil_id' => \App\Models\Ability::inRandomOrder()->first()->id,
            'sess_id' => \App\Models\Session::inRandomOrder()->first()->id,
            'rati_id' => \App\Models\Rating::inRandomOrder()->first()->id,
            'eval_comment' => $this->faker->sentence(),
        ];
    }
}
