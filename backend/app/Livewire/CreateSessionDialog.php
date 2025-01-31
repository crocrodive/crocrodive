<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\DivingGroup;
use App\Models\Evaluation;
use App\Models\Session;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateSessionDialog extends Component
{   

    public $session;
    public $isOpen = false;

    public Array $selectedAttendees = [];

    public $selectedInitiators = [];
    public $sessionDate = null;

    public $abilities = [];

    public $selectedAbility = '';

    public $userAbilities = [];

    public $assignedStudents = [];

    protected $rules = [
        'sessionDate' => 'required|date|after:now',
        'selectedAttendees.*.user_id' => 'required|exists:users,user_id',
        'assignedStudents.*.student_id' => 'required|exists:users,user_id',
        'assignedStudents.*.initiator_id' => 'required|exists:users,user_id',
        'assignedStudents.*.abilities' => 'array|max:3|min:1',
    ];

    protected $messages = [
        'sessionDate.required' => 'La date de la session est obligatoire.',
        'sessionDate.date' => 'La date de la session doit être une date valide.',
        'sessionDate.after' => 'La date de la session doit être postérieure à la date actuelle.',
        'selectedAttendees.*.user_id.required' => 'L\'ID de l\'utilisateur sélectionné est obligatoire.',
        'selectedAttendees.*.user_id.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
        'assignedStudents.*.student_id.required' => 'L\'ID de l\'étudiant assigné est obligatoire.',
        'assignedStudents.*.student_id.exists' => 'L\'étudiant assigné n\'existe pas.',
        'assignedStudents.*.initiator_id.required' => 'Les initiateurs assignés sont obligatoires.',
        'assignedStudents.*.initiator_id.exists' => 'L\'initiateur assigné n\'existe pas.',
        'assignedStudents.*.abilities.array' => 'Les compétences doivent être un tableau.',
        'assignedStudents.*.abilities.max' => 'Un étudiant ne peut avoir plus de 3 compétences.',
        'assignedStudents.*.abilities.min' => 'Un étudiant doit avoir au moins 1 compétence.',
        'assignedStudents.*.abilities.*.exists' => 'La compétence sélectionnée n\'existe pas.',
    ];

    protected $listeners = ['openCreateSessionDialog'];

    public function openCreateSessionDialog($arr)
    {
        $this->isOpen = true;
        $this->selectedAttendees = $arr['selectedAttendees'];
        $this->selectedInitiators = $arr['selectedInitiators'];
        $this->abilities = $arr['allAbilities'];
    
        // Initialiser assignedStudents avec tous les élèves sélectionnés
        $this->selectedAttendees = collect($arr['selectedAttendees'])->toArray(); // Convertir le tableau en collection puis en tableau
        $this->assignedStudents = collect($this->selectedAttendees)->map(function ($attendee) {
            return [
                'student_id' => $attendee['user_id'],
                'initiator_id' => null,
                'abilities' => [null, null, null],
            ];
        })->toArray();
    }

    public function addStudent()
    {
        if (count($this->assignedStudents) <  count($this->selectedAttendees)) {
            $this->assignedStudents[] = [
                'student_id' => null,
                'initiator_id' => null,
                'abilities' => [null, null, null]
            ];
        }
    }

    public function removeStudent($index)
    {
        unset($this->assignedStudents[$index]);
        $this->assignedStudents = array_values($this->assignedStudents);
    }

    public function countStudentsForInitiator($initiatorId)
    {
        return count(array_filter($this->assignedStudents, function ($student) use ($initiatorId) {
            return $student['initiator_id'] == $initiatorId;
        }));
    }

    public function saveSession(){
        $fail = $this->validate();
        foreach($fail['assignedStudents'] as $student){
            if ($student['initiator_id'] === null) {
                session()->flash('error', 'Un étudiant n\'a pas d\'initiateur assigné.');
                return;
            }
        }
        $evalComment = 'Aucune remarque';
        $resp_id = Auth::user()->user_id;
        $date = $this->sessionDate;

        $course = Course::join('users', 'users.user_id', '=', 'croc_courses.manager_user_id')
                    ->where('users.user_id', '=', $resp_id)
                    ->select('croc_courses.cour_id')
                    ->first();
        $course_id = $course['cour_id'];
        $session = new Session();
        $session->cour_id = $course_id;
        $session->sess_date = $date;
        $session->save();
        
        foreach ($this->assignedStudents as $student) {
            $studentId = $student['student_id'];
            $initiatorId = $student['initiator_id'];
            $abilities = $student['abilities'];

            foreach($abilities as $ability){
                if($ability === null){
                    continue;
                }
                Evaluation::create([
                    'user_id' => $studentId,
                    'abil_id' => $ability,
                    'sess_id' => $session['sess_id'],
                    'rati_id' => 1,
                    'eval_comment' => $evalComment
                ]);
            }
        }
        $arrDivingGroup = [];
        foreach($this->assignedStudents as $student) {
            $initiatorId = $student['initiator_id'];
            $divingGroup = DivingGroup::create([
                'instructor_user_id' => $initiatorId,
                'sess_id' => $session['sess_id'],
                'user_id' => $initiatorId
            ]);
            $arrDivingGroup[] = $divingGroup;
        }
        
        foreach($this->assignedStudents as $student) {
            $studentId = $student['student_id'];

            foreach($arrDivingGroup as $divingGroup){
                // UserGroup doesn't work :(
                DB::table('croc_users_groups')->insert([
                    'user_id' => (string) $studentId,
                    'grou_id' => (string) $divingGroup['grou_id'],
                ]);
            }
        }
        $this->sessionDate = '';
        $this->dispatch("updateSession");
        $this->isOpen = false;
    }

    public function addAbility($studentIndex)
    {
        if (count($this->assignedStudents[$studentIndex]['abilities']) < 3) {
            $this->assignedStudents[$studentIndex]['abilities'][] = null;
        }
    }
    
    public function removeAbility($studentIndex, $abilityIndex)
    {
        unset($this->assignedStudents[$studentIndex]['abilities'][$abilityIndex]);
        $this->assignedStudents[$studentIndex]['abilities'] = array_values($this->assignedStudents[$studentIndex]['abilities']);
    }
    public function render()
    {
        return view('livewire.create-session-dialog');
    }
}
