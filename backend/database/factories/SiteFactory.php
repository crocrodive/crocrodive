<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'town_insee' => \App\Models\Town::inRandomOrder()->first()->insee,
            'site_name' => $this->faker->randomElement(['Mer' . $this->faker->randomDigit(), 'Océan' . $this->faker->randomDigit(), 'Piscine' . $this->faker->randomDigit(), 'Lac' . $this->faker->randomDigit()]),
            'site_address' => $this->faker->address(),
        ];
    }
}
