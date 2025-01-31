<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Level;
use App\Enum\Roles;

class AddMember extends Component
{

    /****************** */
    /****Edit user**** */
    /****************** */
    public $userPicked;
    public $rolesAvailable = [Roles::ATTENDEE, Roles::INSTRUCTOR];

    /**************************
     * Dropdown menu dependant
    **************************/

    public $levels;
    public $roles = [Roles::ATTENDEE];

    public $levelPicked;


    /******************
     * Sucess Messages
     *****************/

    public $successMessage = false;  // Variable pour afficher le message de succès
    public $successMessageEdit = false;  // Variable pour afficher le message de succès
    public $successMessageDelete = false;  // Variable pour afficher le message de succès
 

    /***************
     * Modals
     ***************/

    public $showModal = false;  // Variable pour afficher le modal
    public $showModalEdit = false;  // Variable pour afficher le modal d'édition
    public $showModalDelete = false;  // Variable pour afficher le modal de suppression


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

    public function ouvrirModalEdit($value)
    {
        $this->showModalEdit = true;
        $this->userPicked = User::find($value)->first();   
        $this->levelPicked = $this->userPicked["leve_id"];
        $this->userPickedRole = $this->userPicked["role_id"];
    }

    public function fermerModalEdit()
    {
        $this->showModalEdit = false;
    }

    public function ouvrirModalDelete($value)
    {
        $this->showModalDelete = true;
        $this->userPicked = User::find($value)->first();   
    }

    public function fermerModalDelete()
    {
        $this->showModalDelete = false;
    }

    public function mount()
    {
        if (session('success')) {
            $this->successMessage = true;
        }
        if(session('success_edit')){
            $this->successMessageEdit = true;
        }
        if(session('success_message')){
            $this->successMessageDelete = true;
        }
        $this->levels = Level::all();
        $userPicked = $this->userPicked;
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
        $rolesAvailable = $this->rolesAvailable;

        // Passer la variable successMessage à la vue
        return view('livewire.add-member', compact('roles', 'levels', 'users', 'successMessage', 'rolesAvailable'));
    }
}