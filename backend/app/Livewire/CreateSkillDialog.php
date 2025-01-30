<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Skill;

class CreateSkillDialog extends Component
{
    public $level;
    public $isOpen = false;
    public $skillLabel;

    protected $rules = [
        'skillLabel' => 'required|string|max:128',
    ];

    protected $listeners = ['openCreateSkillDialog'];

    public function openCreateSkillDialog($level)
    {
        $this->level = $level;
        $this->isOpen = true;
    }

    public function saveSkill()
    {
        $this->validate();
        $skill = new Skill();
        $skill->createSkillAtLevelName(['skil_label' => $this->skillLabel], $this->level);
        // $skill->save();
        $this->dispatch("updateSkills");
        // Save the skill logic here
        $this->reset('skillLabel');
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.create-skill-dialog');
    }
}