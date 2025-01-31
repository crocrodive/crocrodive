@props(['pageName'])
@php
    $pages = [
        'dashboard' => ["Accueil", "home"],
        'profile' => ["Profil", "profile"],
        'manage' => ["Gestion", ""],
        'formation' => ["Formation", ""],
    ];
@endphp
<div class="bg-background-100 w-full h-screen max-w-64 flex flex-col py-6">
    @foreach ($pages as $page => $value)
        @if($page === $pageName)
            <x-sidenav-menu-item :pageName="$value[0]" :page="$page" :imageName="$value[1]" :active="true"/>
            @continue
        @endif
        <x-sidenav-menu-item :pageName="$value[0]" :page="$page" :imageName="$value[1]"/>
    @endforeach
</div>