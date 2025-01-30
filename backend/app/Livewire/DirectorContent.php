<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Skill;

class DirectorContent extends Component
{
    public $menuOptions = ['N1', 'N2', 'N3' ];
    public $selectedOption = 'N1'; // Option par défaut
    
    public $skills = [] ;
    
    protected $listeners = [
        'menuOptionSelected' => 'updateSelectedOption',
        'updateSkills'=> 'updateSkills',
    ];
    public function openCreateSkillDialog()
    {
        $this->dispatch('openCreateSkillDialog',  ['level' => $this->selectedOption]);
    }
    public function openUpdateSkillDialog($skill){
        $skill = json_encode($skill);
        $this->dispatch('openUpdateSkillDialog',$skill ) ;
    }
    public function updateSelectedOption($option)
    {
        $this->selectedOption = $option;
        $this->updateSkills();
    }

    public function updateSkills(){
        $skillModel = new Skill();
        $this->skills = $skillModel->getSkillsFromLevelLabel($this->selectedOption);
    }

    public function mount ()   {
        $skillModel = new Skill();
        $this->skills = $skillModel->getSkillsFromLevelLabel($this->selectedOption);
    }

    public function render()
    {
        return view('livewire.director-content');
    }
}

