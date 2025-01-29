<div>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Créer un compte
                </h2>
            </div>
            
            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4">
                        <ul class="list-disc pl-5 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Nom -->
                <div>
                    <label for="lastname" class="block text-sm font-medium text-gray-700">
                        Nom
                    </label>
                    <input id="lastname" 
                           name="lastname" 
                           type="text" 
                           required 
                           value="{{ old('lastname') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Doe">
                </div>
                <!-- Prénom -->
                <div>
                    <label for="firstname" class="block text-sm font-medium text-gray-700">
                        Prénom
                    </label>
                    <input id="firstname" 
                           name="firstname" 
                           type="text" 
                           required 
                           value="{{ old('firstname') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="John">
                </div>
                <!-- Date de naissance -->
                <div>
                    <label for="birthdate" class="block text-sm font-medium text-gray-700">
                        Date de naissance
                    </label>
                    <input id="birthdate" 
                           name="birthdate" 
                           type="date" 
                           required 
                           value="{{ old('birthdate') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                </div>
                <!-- Numéro de téléphone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        Numéro de téléphone
                    </label>
                    <input id="phone" 
                           name="phone" 
                           type="tel" 
                           required 
                           value="{{ old('phone') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="0123456789">
                </div>
                <!-- Adresse email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Adresse email
                    </label>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           required 
                           value="{{ old('email') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="john@example.com">
                </div>
                <!-- Rôle -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">
                        Rôle
                    </label>
                    <input id="role" 
                           name="role" 
                           type="text" 
                           required 
                           value="{{ old('role') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Rôle">
                </div>
                <!-- Rôle -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">
                        Rôle
                    </label>
                    <select id="role" 
                            name="role" 
                            required 
                            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        {{--@foreach(App\Models\Role::all() as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach--}}
                    </select>
                </div>
                <!-- Adresse -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">
                        Adresse
                    </label>
                    <input id="address" 
                           name="address" 
                           type="text" 
                           required 
                           value="{{ old('address') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="123 Rue Exemple">
                </div>
                <!-- Ville -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">
                        Ville
                    </label>
                    <input id="city" 
                           name="city" 
                           type="text" 
                           required 
                           value="{{ old('city') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Paris">
                </div>
                <!-- Code postal -->
                <div>
                    <label for="postal_code" class="block text-sm font-medium text-gray-700">
                        Code postal
                    </label>
                    <input id="postal_code" 
                           name="postal_code" 
                           type="text" 
                           required 
                           value="{{ old('postal_code') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="75000">
                </div>
                <!-- Niveau détenu -->
                <div>
                    <label for="current_level" class="block text-sm font-medium text-gray-700">
                        Niveau détenu
                    </label>
                    <input id="current_level" 
                           name="current_level" 
                           type="text" 
                           required 
                           value="{{ old('current_level') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Niveau actuel">
                </div>
                <!-- Niveau préparé -->
                <div>
                    <label for="target_level" class="block text-sm font-medium text-gray-700">
                        Niveau préparé
                    </label>
                    <input id="target_level" 
                           name="target_level" 
                           type="text" 
                           required 
                           value="{{ old('target_level') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="Niveau préparé">
                </div>
                <!-- Numéro de licence -->
                <div>
                    <label for="license_number" class="block text-sm font-medium text-gray-700">
                        Numéro de licence
                    </label>
                    <input id="license_number" 
                           name="license_number" 
                           type="text" 
                           required 
                           value="{{ old('license_number') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                           placeholder="123456789">
                </div>
                <!-- Date de certification médicale -->
                <div>
                    <label for="medical_certification_date" class="block text-sm font-medium text-gray-700">
                        Date de certification médicale
                    </label>
                    <input id="medical_certification_date" 
                           name="medical_certification_date" 
                           type="date" 
                           required 
                           value="{{ old('medical_certification_date') }}"
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Créer mon compte
                    </button>
                </div>

                <div class="text-sm text-center">
                    <a href="{{ route('login_get') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Déjà inscrit ? Connectez-vous
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>