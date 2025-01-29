<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\DivingGroup;
use App\Models\Evaluation;
use App\Models\Session;
use App\Models\Site;
use App\Models\Town;
use App\Models\User;
use App\Models\UserAcquiredAbility;
use App\Models\UserCourse;
use App\Models\UserGroup;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([LevelSeeder::class, RoleSeeder::class, RatingSeeder::class]);
        Town::factory(10)->create();
        User::factory(25)->create();
        Site::factory(10)->create();
        Course::factory(10)->create();
        Session::factory(10)->create();
        DivingGroup::factory(10)->create();
        Evaluation::factory(10)->create();
    }
}
