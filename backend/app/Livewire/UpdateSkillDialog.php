<?php

namespace App\Livewire;
use App\Models\Skill;
use App\Models\Ability;

use Livewire\Component;

class UpdateSkillDialog extends Component
{
    public $skill;
    public $isOpen = false;
    public $skillLabel;
    public $skillAbilities = [];
    public $tempAbilitiesLabelToAdd = [];
    public $tempABilitiesToRemove = [];
    public $abilityLabel;
    protected $rules = [
        'skillLabel' => 'required|string|max:128',
    ];

    protected $abilityLabelRule =[
        'abilityLabel'=> 'required|string|max:128',
    ];
    protected $listeners = ['openUpdateSkillDialog'];

    public function openUpdateSkillDialog($skill)
    {
        $this->skill = json_decode($skill);
        $this->skillLabel = $this->skill->skil_label;
        $ability = new Ability();
        $this->skillAbilities = $ability->getAbilitiesFromSkillLabel($this->skill->skil_id);
        $this->isOpen = true;
    }

    public function saveSkill()
    {
        if (!empty($this->tempAbilitiesLabelToAdd)) {
            foreach ($this->tempAbilitiesLabelToAdd as $abilityLabel) {
                $abilityData['abil_label'] = $abilityLabel;
                $abilityData['skil_id'] = $this->skill->skil_id;
                $ability = new Ability();
                $ability->createAbility($abilityData);
            }
            $this->reset('tempAbilitiesLabelToAdd');
        }

        if (!empty($this->tempABilitiesToRemove)) {
            foreach ($this->tempABilitiesToRemove as $ability) {
                Ability::destroy($ability['abil_id']);
            }
        }

        $this->validate();
        $skill = new Skill();
        $skill->updateLabel($this->skill->skil_id, $this->skillLabel);
        $this->dispatch("updateSkills");
        $this->close();
    }

    public function addAbility(){

        $this->validate($this->abilityLabelRule);
        $this->tempAbilitiesLabelToAdd[] = $this->abilityLabel;
        $this->reset('abilityLabel');
        
    }

    public function close(){
        $this->isOpen = false;
        $this->reset('abilityLabel');
        $this->reset('tempAbilitiesLabelToAdd');
        $this->reset('tempABilitiesToRemove');
        
    }

    public function removeTempAbilityLabel($index){
        unset($this->tempAbilitiesLabelToAdd[$index]);
        $this->tempAbilitiesLabelToAdd = array_values($this->tempAbilitiesLabelToAdd); // Reindex the array    
    }

    public function removeAbility($index){

        $this->tempABilitiesToRemove[] = ($this->skillAbilities[$index]);
        unset($this->skillAbilities[$index]);
        $this->skillAbilities = array_values($this->skillAbilities); // Reindex the array
    }

    public function cancelRemoveAbility($index){
        $this->skillAbilities[] = ($this->tempABilitiesToRemove[$index]);
        unset($this->tempABilitiesToRemove[$index]);
        $this->skillAbilities = array_values($this->skillAbilities);
    }


    public function deleteSkill(){
        $skill = new Skill();
        $skill->deleteSkill($this->skill->skil_id);
        $this->dispatch("updateSkills");
        $this->close();

    }
    
    public function render()
    {
        return view('livewire.update-skill-dialog');
    }
}
