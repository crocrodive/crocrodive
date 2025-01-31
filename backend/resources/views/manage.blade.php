<x-layout>
  <div class="flex flex-col h-full w-full align-middle items-center bg-background-200 mt-8">
   @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-4 w-full max-w-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="h-fit">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <livewire:add-member />
    <x-list :textButton="'Ajouter un membre'">
      @foreach($all_user_value as $user)
        <x-user-card :FirstName="$user->user_firstname" :LastName="$user->user_lastname" :PhoneNumber="$user->user_telephone" :Role="$user->role_id" :Level="$user->leve_name" :Address="$user->user_address"/>
      @endforeach
    </x-list>
  </div>  
</x-layout>
