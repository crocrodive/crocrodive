@props(['password'])
<div class="w-full">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Message copier mot de passe temporaire -->

    <div class="space-y-4">
        <p class="text-h4">Compte créé avec succès</p>
        <p class="text-gray-500">Veuillez le coller dans un endroit sûr.</p>
        <p class="text-gray-500">Le mot de passe temporaire est : <span class="text-primary-100">{{ $password }}</span></p>
    </div>
    
</div>