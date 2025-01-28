<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(entrypoints: 'resources/css/app.css')
</head>
<body class="flex flex-col bg-background-200 h-screen">
    <header class="flex flex-row w-screen items-center justify-between bg-background-100 z-10">
        <x-header/>
    </header>
    <main class="w-full h-full">
        {{ $slot }}
    </main>
</body>
</html>