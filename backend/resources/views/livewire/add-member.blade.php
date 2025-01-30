<div>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <!-- Affichage du message de succès -->
    @if($successMessage)
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            L'utilisateur a été ajouté avec succès. Le login est {{session('login')}} Le mot de passe temporaire est : {{ session('password') }}.
            Copiez le !
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
        <ul>
            @foreach($users as $user)
                <li>{{ $user->user_lastname }} - {{ $user->user_firstname }}</li>
            @endforeach
        </ul>

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
    </div>
</div>
