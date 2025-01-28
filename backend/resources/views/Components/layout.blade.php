<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
{{ $header }}
<body>
    <div class="flex flex-col items-center justify-center gap-8 h-screen bg-background-200" >
        {{ $slot }}
    <div>
</body>
{{ $footer }}
</html>