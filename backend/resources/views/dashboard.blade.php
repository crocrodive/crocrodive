<x-layout>
    <div class="flex flex-row ">
       <x-sideNav/>
        <div class="flex flex-column items-center w-full h-full bg-background-200"  >
            {{-- user type --}}
            @if (true) 
            <x-menu :menuOptions="['Passée','À venir']" />
            @endif
        <div>
    <div>
</x-layout>