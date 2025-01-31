<div class="w-full h-full max-w-4xl px-4 overflow-y-hidden scrollbar-hidden">
    <form action="{{ route('manage_post') }}" method="POST" class="space-y-4 flex flex-col h-full">
        @csrf
        <!-- Header avec croix -->
        <div class="flex items-center justify-between mb-6" style="margin-top: 0;">
            <p class="text-h4 font-bold">Ajouter un membre</p>
            <img src="{{asset('images/croix.png')}}" class="rotate-45 w-8 h-8 cursor-pointer" wire:click="fermerModal" alt="Fermer">    
        </div>
        <hr class="my-4">
        <!-- Champs de formulaire -->
        <div class="space-y-3 overflow-y-scroll z-10">
            <x-input_create_user model="m_lastname" type="text" name="lastname" placeholder="Nom" required="true" />
            <x-input_create_user model="m_firstname" type="text" name="firstname" placeholder="Prénom" required="true" />
            <x-input_create_user model="m_phone" type="text" name="phone" placeholder="Téléphone" required="true" />
            <x-input_create_user model="m_email" type="email" name="email" placeholder="Email" required="true" />
            <x-input_create_user model="m_zipcode" type="text" name="zipcode" placeholder="Code postal" required="true" />
            <x-input_create_user model="m_city" type="text" name="city" placeholder="Ville" required="true" />
            <x-input_create_user model="m_address" type="text" name="address" placeholder="Adresse" required="true" />
            <label class="block text-sm font-medium text-gray-700 mb-1" for="certif">Certificat médical</label>
            <x-input_create_user model="m_certif" type="date" name="certif" placeholder="Certificat médical" required="true" />
            <label class="block text-sm font-medium text-gray-700 mb-1" for="certif">Date naissance</label>
            <x-input_create_user model="m_birthdate" type="date" name="birthdate" placeholder="Date de naissance" required="true" />
            <x-input_create_user model="m_licence" type="text" name="licence" placeholder="N° de licence" required="true" />
            @error('licence')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror

            <!-- Selects -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="level" class="block text-gray-700">Niveau :</label>
                    <select wire:model.live="levelPicked" name="level" id="level" class="w-full bg-gray-100 border border-gray-300 rounded-2xl py-2 px-3">
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}">{{$level->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="space-y-2">
                    <label for="role" class="block text-gray-700">Rôle :</label>
                    <select name="role" id="role" class="w-full bg-gray-100 border border-gray-300 rounded-2xl py-2 px-3">
                        @if($roles)
                            @foreach($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        @endif
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