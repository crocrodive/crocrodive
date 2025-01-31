<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Utilisateurs</title>
    @livewireStyles
</head>
<body>
    <div class="flex min-h-screen">
        <x-side_menu class="w-1/4" /> <!-- Sidebar, occupe 1/4 de la largeur -->
        
        <div class="flex-1 flex flex-col items-center pt-10 f"> <!-- Ajout de pt-10 pour gérer l'espace -->
            <!-- Message d'erreur centré -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4 w-full max-w-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="h-fit">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Formulaire Add Member centré -->
            <div class="w-full max-w-lg">
                <livewire:add-member />
            </div>  
        </div>
    </div>    
    @livewireScripts
</body>
</html>
