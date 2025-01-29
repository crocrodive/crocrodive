<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enum\Roles;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DivingGroup>
 */
class DivingGroupFactory extends Factory
{
    protected string $instructor = Roles::INSTRUCTOR->value;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_user_id' => \App\Models\User::where("role_id", '=', $this->instructor )->inRandomOrder()->first()->user_id,
            'sess_id' => \App\Models\Session::inRandomOrder()->first()->id
        ];
    }
}
