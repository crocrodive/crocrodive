<div class="flex flex-col items-center">
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
        <div class='flex flex-row justify-center border-2 border-cta-300 w-[272px] h-12 rounded-button items-center
        bg-background-100 hover:shadow-buttonBlack transition-all duration-300'>
            <button id="createMember" wire:click="ouvrirModal" class='text-h4 font-poppinsRegular text-cta-300 cursor-pointer'>Ajouter un membre</button>
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
                class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-[calc(50%-20px)]
                    bg-white rounded-lg shadow-lg w-[800px] p-6 h-[70%] overflow-hidden"
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