<x-layout>
    <x-list :textButton="'Ajouter un membre'">
      @foreach($all_user_value as $user)
        <x-user-card :FirstName="$user->user_firstname" :LastName="$user->user_lastname" :PhoneNumber="$user->user_telephone" :Role="$user->role_id" :Level="$user->leve_name" :Address="$user->user_address"/>
      @endforeach
    </x-list>
</x-layout>
