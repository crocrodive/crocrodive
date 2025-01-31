<?php

namespace App\Livewire;

use App\Models\DivingGroup;
use App\Models\Evaluation;
use App\Models\Session;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateSessionDialog extends Component
{
    public $sessionId;

    public $session;
    public $sessionDate;
    public $assignedStudents = [];
    public $allAttendees = [];
    public $selectedInitiators = [];
    public $allInitiators = [];
    public $abilities = [];

    public $course;

    public $group = [];

    public $isOpen = false;

    protected $listeners = ['openUpdateSessionDialog'];

    public function openUpdateSessionDialog($data)
    {
        
        $this->isOpen = true;
        $this->session = $data['session'];
        $this->sessionId = $data['session']['sess_id'];
        $this->sessionDate = $data['session']['sess_date'];
        $this->allAttendees = $data['allAttendees'];
        $this->allInitiators = $data['allInitiators'];
        $this->abilities = $data['allAbilities'];

        $this->course = DB::table('croc_courses as c')
            ->join('croc_sessions as s', 'c.cour_id', '=', 's.cour_id')
            ->where('s.sess_id', $this->sessionId)
            ->select('c.*')
            ->first();

        foreach($this->allInitiators as $initiator){
            $divingGroup = DivingGroup::where('sess_id', $this->sessionId)
            ->where('instructor_user_id', $initiator['user_id'])
            ->first();
            if ($divingGroup) {
                $this->selectedInitiators[] = $initiator['user_id'];
            }
        }

        foreach($this->allInitiators as $initiator){
            $this->selectedInitiators[] = User::where('user_id', $initiator['user_id'])->first();
        }
    }


    public function updateSession()
    {
        $this->validate([
            'sessionDate' => 'required|date|after:now',
            'assignedStudents.*.student_id' => 'required|exists:users,user_id',
            'assignedStudents.*.abilities' => 'array|max:3',
            'assignedStudents.*.abilities.*' => 'exists:abilities,abil_id',
        ]);

        $session = Session::findOrFail($this->sessionId);
        $session->update(['sess_date' => $this->sessionDate]);

        foreach ($this->assignedStudents as $student) {
            foreach ($student['abilities'] as $ability) {
                Evaluation::create([
                    'user_id' => $student['student_id'],
                    'abil_id' => $ability,
                    'sess_id' => $session->sess_id,
                    'rati_id' => 1,
                    'eval_comment' => 'Mise à jour',
                ]);
            }
        }

        $this->dispatch('updateSession');
        $this->dispatch('closeUpdateSessionDialog');
    }

    public function deleteSession($sessionId){
        try {
            $session = Session::findOrFail($sessionId);
            $divingGroups = DB::table('croc_diving_groups')->where('sess_id', $sessionId)->get();
            foreach ($divingGroups as $group) {
                DB::table('croc_users_groups')->where('grou_id', $group->grou_id)->delete();
            }
            DB::table('croc_diving_groups')->where('sess_id', $sessionId)->delete(); 
            $session->evaluations()->delete(); 
            $session->delete();
            $this->dispatch('updateSession');
            $this->dispatch('closeUpdateSessionDialog');
            $this->isOpen = false;
        } catch (\Exception $e) {
            dd(''. $e->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.update-session-dialog', [
            'assignedStudents' => $this->assignedStudents,
        ]);
    }
}
