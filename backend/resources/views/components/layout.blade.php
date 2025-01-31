<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Croco'Dive</title>
    @vite(entrypoints: 'resources/css/app.css')
</head>
<body class="flex flex-col bg-background-200 h-screen">
    <header class="flex flex-row w-screen items-center justify-between bg-background-100 z-10">
        <x-header>
            <div class="text-4xl font-bold select-none">
                Croco'Dive
            </div>
            <div class="flex-grow"></div>
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-lg font-semibold">Déconnexion</button>
                </form>
            @endif
        </x-header>
    </header>
    @php
        $pageName = Request::segment(1);
    @endphp
    <div class="flex flex-row w-full h-full overflow-hidden">
        @if(Auth::check())
            <x-side-nav :pageName="$pageName"/>
        @endif
        <main class="w-full h-full overflow-y-scroll overflow-x-hidden">
            {{ $slot }}
        <main>
    </div>
</body>
</html>