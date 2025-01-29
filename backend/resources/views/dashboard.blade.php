<x-layout>
    <div class="flex flex-row h-full w-full ">
       <x-sideNav/>
        <div class="flex flex-col items-center w-full h-full bg-background-200">
            @if (true) 
                <livewire:user-content />
            @endif
        </div>
    </div>
</x-layout>
