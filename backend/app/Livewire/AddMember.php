<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Level;
use App\Enum\Roles;

class AddMember extends Component
{

    /**************************
     * Dropdown menu dependant
    **************************/

    public $levels;
    public $roles = [Roles::ATTENDEE];

    public $levelPicked;


    /******************
     * Variables
     *****************/

    public $showModal = false;
    public $successMessage = false;  // Variable pour afficher le message de succès

    /******************
     * Models Livewire
     *****************/
    public $m_lastname = '';  //
    public $m_firstname = '';  //
    public $m_phone = '';  //
    public $m_email = '';  //
    public $m_zipcode = '';  //
    public $m_city = '';  //
    public $m_address = '';  //
    public $m_role = '';  //
    public $m_level = '';  //

    // Define properties for form inputs
    public $lastname, $firstname, $phone, $zipcode, $city, $address, $role, $level, $email;

    public function ouvrirModal()
    {
        $this->showModal = true;
    }

    public function fermerModal()
    {
        $this->showModal = false;
    }

    public function mount()
    {
        if (session('success')) {
            $this->successMessage = true;
        }
        $this->levels = Level::all();
    }

    public function updatedLevelPicked($value)
    {
        $level = Level::find($value);
        
        if ($level) {
            $level_name = $level->name; 
            
            if ($level_name == "N1" || $level_name == "Débutant") {
                $this->roles = [Roles::ATTENDEE];  
            }
            else if ($level_name != "N2" && $level_name != "N1" && $level_name != "Débutant"){
                $this->roles = [Roles::INSTRUCTOR];  // Par défaut, l'instructeur si ce n'est pas N1
            }else{
                $this->roles = [Roles::ATTENDEE, Roles::INSTRUCTOR];  // Par défaut, l'élève si c'est N1
            }

        }
    }


    public function render()
    {
        $roles = $this->roles;
        $users = User::all();
        $levels = Level::all();
        $successMessage = $this->successMessage;

        // Passer la variable successMessage à la vue
        return view('livewire.add-member', compact('roles', 'levels', 'users', 'successMessage'));
    }
}