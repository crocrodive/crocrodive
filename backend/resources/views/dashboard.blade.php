<x-layout>
    <x-slot name="header">
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-semibold text-gray-800">
                        Bonjour {{Auth::user()->user_firstname}} {{Auth::user()->user_lastname}} 👋
                    </h1>
                    
                    <div class="mt-4 text-gray-600">
                        Vous êtes connecté.
                    </div>

                </div>
            </div>
        </div>
    </div>
        
     <x-slot name="footer">        
    </x-slot>
</x-layout>
