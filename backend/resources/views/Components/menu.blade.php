@props(['menuOptions','selectedOption' => null])
<div class="flex w-full  h-[104px] bg-background-100 shadow-md shadow-background-300 justify-center items-end">
    <div class=" h-fit flex flex-row gap-8">
        @foreach ($menuOptions as $option)
            <div  id="{{$option}}" 
            class="text-largeText font-poppinsSemiBold menu-item {{ $selectedOption === $option ? 'active' : '' }}"
            wire:click.prevent="$emit('menuOptionSelected', '{{ $option }}')"
             >{{$option}}</div>
        @endforeach 
    </div>
</div>

<style>
    .menu-item {
        color: #000000;
        text-decoration: none;
        cursor: pointer;
    }
    .menu-item.active {
        color: #6534CD;
        text-decoration: underline;
    }
</style>