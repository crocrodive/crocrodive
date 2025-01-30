@props(['user'])
<div class="flex rounded-cards bg-background-100 min-h-400 min-w-400 p-4">
    <div class="mb-2">
        <p class="block">{{ $user->user_lastname }} - {{ $user->user_firstname }}</p>
    </div>
    <div class="mb-2">
        <p class="block"> {{$user->user_telephone}}</p>
    </div>
    <div class="mb-2">
        <p> {{$user->user_address}}</p>
    </div>
</div>