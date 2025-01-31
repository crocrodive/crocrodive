@props(['pageName'])
@php
    // ATTENDEE, INSTRUCTOR, COURSE_MANAGER, TECHNICAL_DIRECTOR
    $pages = [
        'dashboard' => ["Accueil", "home", ["ATTENDEE", "INSTRUCTOR", "COURSE_MANAGER", "TECHNICAL_DIRECTOR"]],
        'profile' => ["Profil", "profile", ["ATTENDEE", "INSTRUCTOR", "COURSE_MANAGER", "TECHNICAL_DIRECTOR"]],
        'planning' => ["Planning", "", ["ATTENDEE", "INSTRUCTOR","COURSE_MANAGER"]], 
        'manage' => ["Gestion", "", ["TECHNICAL_DIRECTOR"]],
        'formation' => ["Formation", "", ["TECHNICAL_DIRECTOR"]],
        'skills' => ["Compétences", "", ["TECHNICAL_DIRECTOR"]],
        'sessions' => ["Séances", "", ["COURSE_MANAGER"]],
    ];

    $user_role = App\Enum\Roles::from(Auth::user()->role_id)->name;
@endphp
<div class="bg-background-100 w-full h-screen max-w-72 flex flex-col py-6">

    @foreach ($pages as $page => $value)
        @if(!in_array($user_role, $value[2]))
            @continue
        @endif
        @if($page === $pageName)
            <x-sidenav-menu-item :pageName="$value[0]" :page="$page" :imageName="$value[1]" :active="true"/>
            @continue
        @endif
        <x-sidenav-menu-item :pageName="$value[0]" :page="$page" :imageName="$value[1]"/>
    @endforeach
</div>