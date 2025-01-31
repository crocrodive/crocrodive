<?php

namespace Database\Seeders;

use App\Enum\Roles;
use App\Models\Ability;
use App\Models\Course;
use App\Models\DivingGroup;
use App\Models\Evaluation;
use App\Models\Session;
use App\Models\User;
use App\Enum\GroupEvaluationState;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class SeederForGabrielle extends Seeder
{
    private const ATTENDEE_EMAIL = 'eleve@eleve';
    private const INSTRUCTOR_EMAIL = 'init@init';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users
        $instructors = self::createInstructors();
        $attendees = self::createAttendees();

        $users = array_merge($instructors, $attendees);

        $course = Course::factory()->create();

        // Create course
        DB::table('croc_users_courses')->insert(
            array_map(fn ($user) => [
                'user_id' => $user->user_id,
                'cour_id' => $course->id,
            ], $users),
        );

        // Create sessions
        $sessions = self::createSessions($course);
        self::fillSessions(
            $sessions,
            $instructors,
            $attendees,
            $course,
        );
    }

    /**
     * @return User[]
     */
    private function createInstructors(): array {
        $instructors = User::factory(2)->create(['role_id' => Roles::INSTRUCTOR])->all();
        $instructors[] = User::where('email', self::INSTRUCTOR_EMAIL)->first();
        return $instructors;
    }

    /**
     * @return User[]
     */
    private function createAttendees(): array {
        $attendees = User::factory(5)->create(['role_id' => Roles::ATTENDEE])->all();
        $attendees[] = User::where('email', self::ATTENDEE_EMAIL)->first();
        return $attendees;
    }

    /**
     * @param Course $course
     * @return Session[]
     */
    private function createSessions(Course $course): array {
        $pastSessions = Session::factory(2)->create([
            'cour_id' => $course->id,
            'sess_date' => now()->subDays(2)
        ])->all();
        $futureSessions = Session::factory(2)->create([
            'cour_id' => $course->id,
            'sess_date' => now()->addDays(2)
        ])->all();

        return array_merge($pastSessions, $futureSessions);
    }

    /**
     * @param Session[] $sessions
     * @param User[] $instructors
     * @param User[] $attendees
     * @param Course $course
     * @return void
     */
    private function fillSessions(
        array $sessions,
        array $instructors,
        array $attendees,
        Course $course,
    ): void {
        // Get all available abilities for this course
        $abilities = self::getAvailableAbilities($course);

        foreach($sessions as $session) {
            /**
             * @var string[]
             */
            $pickedUsersIndexes = [];
            // Form 3 groups for each session
            foreach($instructors as $instructor) {
                $data = [
                    'sess_id' => $session->id,
                    'instructor_user_id' => $instructor->user_id,
                ];

                if($session->date < now()) {
                    $data['grou_state'] = rand(0, 1) === 1 ? GroupEvaluationState::EVALUATED : GroupEvaluationState::TO_BE_EVALUATED;
                    //$data['grou_state'] = GroupEvaluationState::EVALUATED;
                } else {
                    $data['grou_state'] = GroupEvaluationState::UPCOMING;
                }

                $group = DivingGroup::factory()->create($data);

                $i = 0;
                while($i < 2 && count($pickedUsersIndexes) < count($attendees)) {
                    $index = rand(0, count($attendees) - 1);
                    while(in_array($index, $pickedUsersIndexes)) {
                        $index = rand(0, count($attendees) - 1);
                    }

                    $pickedUsersIndexes[] = $index;
                    DB::table('croc_users_groups')->insert([
                        'grou_id' => $group->id,
                        'user_id' => $attendees[$index]->user_id,
                    ]);

                    $i++;
                }
            }

            // Create evaluations for each attendee
            foreach($attendees as $attendee) {
                for($i = 0; $i < 3; $i++) {
                    $pickedAbilitiesIndexes = [];
                    $index = -1;
                    do {
                        $index = rand(0, count($abilities) - 1);
                    } while(in_array($index, $pickedAbilitiesIndexes));

                    $ability = $abilities[$index];
                    $pickedAbilitiesIndexes[] = $index;

                    $data = [
                        'user_id' => $attendee->user_id,
                        'abil_id' => $ability->id,
                        'sess_id' => $session->id,
                    ];

                    // Don't give a rating if the session has not happened yet
                    if($session->date > now()) {
                        $data['rati_id'] = 1;
                    }

                    Evaluation::factory()->create($data);
                }
            }
        }
    }

    /**
     * @param Course $course
     * @return \App\Models\Ability[]
     */
    private function getAvailableAbilities(Course $course): array {
        $level_id = $course->leve_id;
        return Ability::join('croc_skills', 'croc_skills.skil_id', '=', 'croc_abilities.skil_id')
            ->where('leve_id', '=', $level_id)
            ->get()
            ->all()
        ;
    }
}
