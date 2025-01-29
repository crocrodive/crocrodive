<x-layout>
    <x-slot name="header">
    </x-slot>
        <form method="POST" action="{{ route('login_post') }}">
        @csrf
            <x-card>
                <div class="flex flex-col items-center justify-center gap-4 p-8">
                    <div class="text-h4">Connexion</div>
                    <x-input type="text" name="email" placeholder="Identifiant"/>
                    <x-input type="password" name="password" placeholder="Mot de passe"/>
                    <x-button>Connexion</x-button>
                    @if ($errors->any())
                        <div class="rounded-md bg-red-50 p-4 mb-4">
                            <ul class="list-disc pl-5 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </x-card>
        </form>
     <x-slot name="footer">        
    </x-slot>
    <div>
</x-layout>