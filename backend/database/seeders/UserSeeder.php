<?php

namespace Database\Seeders;

use App\Enum\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(25)->create();

        User::factory()->create([
            'email' => 'direct@direct',
            'password' => 'direct',
            'role_id' => Roles::TECHNICAL_DIRECTOR,
        ]);

        User::factory()->create([
            'email' => 'resp@resp',
            'password' => 'resp',
            'role_id' => Roles::COURSE_MANAGER,
        ]);

        User::factory()->create([
            'email' => 'init@init',
            'password' => 'init',
            'role_id' => Roles::INSTRUCTOR,
        ]);

        User::factory()->create([
            'email' => 'eleve@eleve',
            'password' => 'eleve',
            'role_id' => Roles::ATTENDEE,
        ]);
    }
}
