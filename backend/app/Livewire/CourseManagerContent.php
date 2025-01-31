<?php

namespace App\Livewire;

use App\Enum\Roles;
use App\Models\Ability;
use App\Models\Course;
use App\Models\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CourseManagerContent extends Component
{
    public $sessions = [];
    public $manager_sessions = [];
    public $allInitiators = [];
    public $userAbility = [];
    public $allAbilities = [];

    protected $listeners = [
        'updateSession'=> 'updateSession'
    ];
    public $selectedOption = 'Séances'; // Option par défaut

    public function openCreateSessionDialog(){
        $resp_id = Auth::user()['user_id'];

        $course = Course::join('users', 'croc_courses.manager_user_id', '=', 'users.user_id')
            ->where('users.user_id', $resp_id)
            ->select('croc_courses.cour_id', 'croc_courses.manager_user_id', 'users.user_id', 'users.user_firstname', 'users.user_lastname', 'users.role_id')
            ->first();
        if(!$course){
            return;
        }
        $course_id = $course['cour_id'];
        $selectedAttendees = $this->getAssignedStudents($course_id);

        $allAbilities = Ability::all();
        $this->dispatch('openCreateSessionDialog', ['selectedAttendees' => $selectedAttendees, 'selectedInitiators' => $this->allInitiators, 'allAbilities' => $allAbilities]);
    }

    public function openUpdateSessionDialog($session)
    {
        $allAttendees = $this->getAssignedStudents($session['cour_id']);
            
        $allAbilities = Ability::all();

        $this->dispatch('openUpdateSessionDialog', [
            'session' => $session,
            'allAttendees' => $allAttendees,
            'allInitiators' => $this->allInitiators,
            'allAbilities' => $allAbilities
        ]);
    }

    private function getAssignedStudents($course_id)
    {
        return User::join('croc_users_courses', 'users.user_id', '=', 'croc_users_courses.user_id')
            ->join('croc_courses', 'croc_users_courses.cour_id', '=', 'croc_courses.cour_id')
            ->where('users.role_id', Roles::ATTENDEE)
            ->where('croc_courses.cour_id', $course_id)
            ->select('users.user_id', 'croc_courses.manager_user_id', 'users.user_lastname', 'users.user_firstname', 'users.role_id', 'croc_courses.cour_id')
            ->get();
    }

    public function mount(){
        $resp_id = Auth::user()->user_id;
        $this->manager_sessions = Session::join('croc_courses', 'croc_courses.cour_id', '=', 'croc_sessions.cour_id')
        ->join('users', 'croc_courses.manager_user_id', '=', 'users.user_id')
        ->where('users.user_id', '=', $resp_id)
        ->where('croc_sessions.sess_date', '>', now())
        ->select('croc_sessions.*')
        ->get();
        
        $this->allInitiators = User::where('role_id', Roles::INSTRUCTOR)->get();
    }

    public function updateSession(){
        $resp_id = Auth::user()->user_id;
        $this->manager_sessions = Session::join('croc_courses', 'croc_courses.cour_id', '=', 'croc_sessions.cour_id')
        ->join('users', 'croc_courses.manager_user_id', '=', 'users.user_id')
        ->where('users.user_id', '=', $resp_id)
        ->where('croc_sessions.sess_date', '>', now())
        ->select('croc_sessions.*')
        ->get();
        $this->allInitiators = User::where('role_id', Roles::INSTRUCTOR)->get();
    }

    public function render()
    {
        return view('livewire.course-manager-content', ['manager_sessions' => $this->manager_sessions]);
    }
}
