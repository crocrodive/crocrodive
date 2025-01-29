<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        return [    
            "role_id" => $this->faker->randomElement(['Attendee', 'Course Manager', 'Instructor', 'Technical Director']),
            "leve_id" => $this->faker->numberBetween(1,4),
            "user_lastname" => $this->faker->lastName(),
            "user_firstname" => $this->faker->firstName(),
            "user_telephone" => $this->faker->serviceNumber(),
            "email" => $this->faker->unique()->safeEmail(),
            "password"=> Hash::make("temp"),
            "user_is_password_temporary" => true,
            "user_diploma_date" => $this->faker->date(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
