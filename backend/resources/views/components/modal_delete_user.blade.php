<div class="w-full max-w-4xl p-4 max-h-screen overflow-y-auto scrollbar-hidden">
    <form action="{{ route('delete_user', ['id' => $user->user_id]) }}" method="POST" class="space-y-4">
        @csrf
        <!-- Header avec croix -->
        <div class="flex items-center justify-between mb-6">
            <p>Voulez vous supprimer l'utilisateur {{$user->user_firstname}} {{$user->user_lastname}}</p>

        <!-- Bouton -->
        <div class="mt-6 flex space-x-2 items-center">
            <x-delete-button type="submit" class="bg-alert-danger text-h4 text-textcolor-darkmode rounded-cards p-2"> Supprimer </x-delete-button>
            <button class="bg-white text-h4 text-primary-100 border-primary-100 border-2 rounded-cards p-2" 
            >Annuler</button>
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