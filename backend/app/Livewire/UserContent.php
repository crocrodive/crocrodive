<?php

namespace App\Livewire;

use Livewire\Component;

class UserContent extends Component
{

    public $menuOptions = ['Passée', 'À venir' ];
    public $selectedOption = 'À venir'; // Option par défaut

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
