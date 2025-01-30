<div class="h-full w-full flex flex-col">
    <div class="flex w-full h-min-[104px]  h-[104px] bg-background-100 shadow-md shadow-background-300 justify-center items-end">
        <div class=" h-fit flex flex-row gap-8">
            @foreach ($menuOptions as $option)
                <div  
                id="{{$option}}" 
                class="text-largeText font-poppinsSemiBold menu-item {{ $selectedOption === $option ? 'text-purple-700 underline' : 'text-black no-underline cursor-pointer' }}"
                wire:click.prevent="updateSelectedOption('{{ $option }}')"
                 >
                    {{$option}}
                </div>
            @endforeach 
        </div>
    </div>
    <div class="flex flex-col items-center  w-full h-full gap-8 p-8">
        <div class='flex flex-row justify-center border-2 border-cta-300 w-[400px] h-12 rounded-button items-center
      bg-background-100 hover:shadow-buttonBlack transition-all duration-300'>
        <button id="createMember" class='text-h4 font-poppinsRegular text-cta-300 cursor-pointer'
        wire:click.prevent="openCreateSkillDialog()"
        >Ajouter une compétence</button>
      </div>
        <div class=" grid-cols-3 grid gap-8">
            @foreach ($skills as $skill)
                <x-card>
                    <div class="w-[300px] h-[88px] flex justify-center items-center text-ellipsis p-4 hover:bg-blue-50 hover:rounded-cards cursor-pointer"
                    wire:click.prevent="openUpdateSkillDialog({{ json_encode($skill) }})"
                    >{{$skill['skil_label']}}</div>
                </x-card>
            @endforeach
        </div>
    </div>
    @livewire('create-skill-dialog')
    @livewire('update-skill-dialog')
</div>