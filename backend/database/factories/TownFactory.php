<?php

namespace Database\Factories;

use App\Models\Town;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Town>
 */
class TownFactory extends Factory
{
    protected $model = Town::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'town_insee' => $this->faker->unique()->numerify('#####'), 
            'town_postal_code' => $this->faker->postcode, 
            'town_name' => $this->faker->city, 
        ];
    }
}
