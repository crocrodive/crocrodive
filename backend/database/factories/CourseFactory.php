<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enum\Roles;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected string $course_manager = Roles::COURSE_MANAGER->value;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manager_user_id' => \App\Models\User::where("role_id", '=', $this->course_manager )->inRandomOrder()->first()->user_id,
            'leve_id' => \App\Models\Level::inRandomOrder()->where('leve_has_courses', '=', '1')->first()->id,
            'site_id' => \App\Models\Site::inRandomOrder()->first()->id,
            'cour_start_date' => $this->faker->date(),
        ];
    }
}
