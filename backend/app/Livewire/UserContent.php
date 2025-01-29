<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserCourse;
use App\Models\Session;
use App\Models\Evaluation;
use App\Models\Ability;
use App\Models\Skill;
use App\Models\Rating;
use App\Models\DivingGroup;
use App\Models\User;
use Carbon\Carbon;

class UserContent extends Component
{
    public $sessionDetails = [];
    public $menuOptions = ['Passée', 'À venir' ];
    public $selectedOption = 'À venir'; // Option par défaut
    
    public function getSessionDetails()
    {
        $userCoursesAttributes = UserCourse::all()[0]->getAttributes();
        $cour_id = $userCoursesAttributes['cour_id'];

        $sessionsAttributes = Session::where('cour_id', $cour_id)->get()
            ->map(function ($session) {
                return $session->getAttributes();
            })->toArray();

        $evaluationsAttributes = Evaluation::whereIn('sess_id', array_column($sessionsAttributes, 'sess_id'))->get()
            ->map(function ($evaluation) {
                return $evaluation->getAttributes();
            })->toArray();

        $abilitiesAttributes = Ability::whereIn('abil_id', array_column($evaluationsAttributes, 'abil_id'))->get()
            ->map(function ($ability) {
                return $ability->getAttributes();
            })->toArray();

        $skillsAttributes = Skill::whereIn('skil_id', array_column($abilitiesAttributes, 'skil_id'))->get()
            ->map(function ($skill) {
                return $skill->getAttributes();
            })->toArray();

        $ratingsAttributes = Rating::whereIn('rati_id', array_column($evaluationsAttributes, 'rati_id'))->get()
            ->map(function ($rating) {
                return $rating->getAttributes();
            })->toArray();

        $instructorUserIds = DivingGroup::whereIn('sess_id', array_column($sessionsAttributes, 'sess_id'))->pluck('instructor_user_id', 'sess_id')->toArray();

        $instructor = User::whereIn('user_id', $instructorUserIds)->first(['user_firstname', 'user_lastname']);
        $sessionDetails = [];

        if ($instructor) {
            $instructorName = $instructor->user_firstname . ' ' . $instructor->user_lastname;
        } else {
            $instructorName = 'Unknown Instructor';
        }

        foreach ($sessionsAttributes as $session) {
            $sessionId = $session['sess_id'];
            $sessionDate = Carbon::parse($session['sess_date'])->format('d/m/Y');
            $sessionAbilities = [];

            foreach ($evaluationsAttributes as $evaluation) {
                if ($evaluation['sess_id'] === $sessionId) {
                    foreach ($abilitiesAttributes as $ability) {
                        if ($ability['abil_id'] === $evaluation['abil_id']) {
                            $sessionAbilities[] = (object) [
                                'evaluationAbilityName' => $ability['abil_label'],
                                'evaluationRating' => collect($ratingsAttributes)->firstWhere('rati_id', $evaluation['rati_id'])['rati_label']
                            ];
                        }
                    }
                }
            }

            $sessionDetails[] = (object) [
                'sessionInitiatorName' => $instructor ? $instructor->user_firstname . ' ' . $instructor->user_lastname : 'Unknown Instructor',
                'sessionDate' => $sessionDate,
                'sessionUserEvaluations' => $sessionAbilities
            ];
        }

        return $sessionDetails;
    }
   
    public function mount()
    {
        $this->sessionDetails = $this->getSessionDetails();
    }

    protected $listeners = [
        'menuOptionSelected' => 'updateSelectedOption',
    ];

    public function updateSelectedOption($option)
    {
        $this->selectedOption = $option;
    }

    public function render()
    {
        return view('livewire.user-content');
    }
}
