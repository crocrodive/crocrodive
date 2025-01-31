<div>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <!-- Affichage du message de succès -->
    @if($successMessage)
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            L'utilisateur a été ajouté avec succès. Le login est {{session('login')}} Le mot de passe temporaire est : {{ session('password') }}.
            Copiez le !
        </div>
    @endif
    @if($successMessageEdit)
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            L'utilisateur a été modifié avec succès.
        </div>
    @endif
    @if($successMessageDelete)
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            L'utilisateur a été supprimé avec succès.
        </div>
    @endif
    

    <div class="relative">
        <!-- Bouton Ajouter membre -->
        <button 
            wire:click="ouvrirModal" 
            class="bg-white text-h4 text-primary-100 border-primary-100 border-2 rounded-cards p-2" 
        >
            Ajouter membre
        </button>    
        <!-- Liste des membres -->
            <div class="space-y-2">
                @foreach($users as $user)
                <div class="flex">
                    <div class="block">{{ $user->user_lastname }} - {{ $user->user_firstname }}</div>
                    @if($user->role_id != "Directeur Technique" && $user->role_id != "Responsable de formation")
                        <button wire:click="ouvrirModalEdit({{$user}})">
                            <img class="h-4 w-4 ml-4 items-center" src="{{asset('images/editer.png')}}" alt="">
                        </button>
                        <button wire:click="ouvrirModalDelete({{$user}})">
                            <img class="rotate-45 h-4 w-4 ml-4 items-center" src="{{asset('images/croix.png')}}" alt="">
                        </button>
                    @endif
                </div>
                @endforeach
            </div>

        <!-- Système Modal Ajouter membre -->
        @if($showModal)
            <!-- Overlay -->
            <div 
                class="fixed top-0 left-0 w-full h-full bg-black/50"
                wire:click="fermerModal"
            ></div>

            <!-- Contenu du modal -->
            <div
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                    bg-white rounded-lg shadow-lg w-[800px] p-6"
            >
                <x-modal_create_user
                    :levels="$levels"
                    :roles="$roles"
                />
            </div>
        @endif


        @if($showModalEdit)
            <!-- Overlay -->
            <div 
                class="fixed top-0 left-0 w-full h-full bg-black/50"
                wire:click="fermerModalEdit"
            ></div>

            <!-- Contenu du modal -->
            <div
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                    bg-white rounded-lg shadow-lg w-[800px] p-6"
            >
                <x-modal_edit_user
                    :levels="$levels"
                    :roles="$rolesAvailable"
                    :user="$userPicked"
                />
            </div>
        @endif

        @if($showModalDelete)
            <!-- Overlay -->
            <div 
                class="fixed top-0 left-0 w-full h-full bg-black/50"
                wire:click="fermerModalDelete"
            ></div>

            <!-- Contenu du modal -->
            <div
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                    bg-white rounded-lg shadow-lg w-[800px] p-6"
            >
                <x-modal_delete_user
                    :user="$userPicked"
                />
            </div>
        @endif
    </div>
</div>
