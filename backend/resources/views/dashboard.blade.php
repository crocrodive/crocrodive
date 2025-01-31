<x-layout>
    <div class="flex flex-row h-full w-full">
        <div class="flex flex-col items-center justify-center w-full h-full bg-background-200">
            <h1 class="text-4xl font-bold text-center mt-10">Bonjour, {{ Auth::user()->user_firstname }} {{ Auth::user()->user_lastname }} 👋</h1>
        </div>
    </div>
</x-layout>
