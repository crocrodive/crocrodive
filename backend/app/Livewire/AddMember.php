<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Level;
use App\Enum\Roles;

class AddMember extends Component
{
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
    }

    public function render()
    {
        $roles = [Roles::ATTENDEE, Roles::INSTRUCTOR];
        $users = User::all();
        $levels = Level::all();
        $successMessage = $this->successMessage;

        // Passer la variable successMessage à la vue
        return view('livewire.add-member', compact('roles', 'levels', 'users', 'successMessage'));
    }
}