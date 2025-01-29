<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Session;
use Carbon\Carbon;


class UserContent extends Component
{
    public $sessionsDetails = [];
    public $menuOptions = ['Passée', 'À venir' ];
    public $selectedOption = 'À venir'; // Option par défaut
    
    public function getUserSessionsDetails()
    {
        $sessionsDetails = [];
        $session = new Session();
        $sessionsDetails = $session->getUserSessionsDetails(userId: auth()->user()->user_id);
        return $sessionsDetails;
    }
   
    public function mount()
    {
        $this->sessionsDetails = $this->getUserSessionsDetails();
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
