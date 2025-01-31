<div class="w-full max-w-4xl p-4 max-h-screen overflow-y-auto scrollbar-hidden">
    <form action="{{ route('update_user', ['id' => $user->user_id]) }}" method="POST" class="space-y-4">
        @csrf
        <!-- Header avec croix -->
        <div class="flex items-center justify-between mb-6">
            <p class="text-h4">Modifier les informations d' un membre</p>
            <img src="{{asset('images/croix.png')}}" class="rotate-45 w-4 h-4 cursor-pointer" wire:click="fermerModal" alt="Fermer">    
        </div>

        <!-- Champs de formulaire -->
        <div class="space-y-3">
            <!-- Modèle input data -->
            <x-input_edit_user type="text" name="lastname" value="{{ $user->user_lastname }}" placeholder="Nom" required="true" />
            <x-input_edit_user type="text" name="firstname" value="{{ $user->user_firstname }}" placeholder="Prénom" required="true" />
            <x-input_edit_user type="text" name="phone" value="{{ $user->user_telephone }}" placeholder="Téléphone" required="true" />
            <x-input_edit_user type="text" name="zipcode" value="{{ $user->user_postal_code }}" placeholder="Code postal" required="true" />
            <x-input_edit_user type="text" name="city" value="{{ $user->user_city }}" placeholder="Ville" required="true" />
            <x-input_edit_user type="text" name="address" value="{{ $user->user_address }}" placeholder="Adresse" required="true" />
            <label class="block text-sm font-medium text-gray-700 mb-1" for="certif">Certificat médical</label>
            <x-input_edit_user type="date" name="certif" value="{{ $user->user_medical_cert_date }}" placeholder="Certificat médical" required="true" />
            <label class="block text-sm font-medium text-gray-700 mb-1" for="certif">Date naissance</label>
            <x-input_edit_user type="date" name="birthdate" value="{{ $user->user_birth_date }}" placeholder="Date de naissance" required="true" />
            <x-input_edit_user type="text" name="licence" value="{{ $user->user_diving_license_number }}" placeholder="N° de licence" required="true" />

            <!-- Selects -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="level" class="block text-gray-700">Niveau :</label>
                    <select name="level" id="level" class="w-full bg-gray-100 border border-gray-300 rounded-2xl py-2 px-3">
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}">{{$level->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label for="role" class="block text-gray-700">Rôle :</label>
                    <select name="role" id="role" class="w-full bg-gray-100 border border-gray-300 rounded-2xl py-2 px-3">
                        @foreach($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Bouton -->
        <div class="mt-6">
            <x-button class="w-full"> Enregistrer </x-button>
        </div>
    </form>
</div>


<style>
    .scrollbar-hidden::-webkit-scrollbar {
    display: none;
}

.scrollbar-hidden {
    -ms-overflow-style: none;  /* Pour IE et Edge */
    scrollbar-width: none;     /* Pour Firefox */
}
</style>