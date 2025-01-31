<div class="h-full w-full flex flex-col">
    <div class="flex flex-col items-center p-8 gap-14">
        <div class='flex flex-row justify-center border-2 border-cta-300 w-[400px] h-12 rounded-button items-center
    bg-background-100 hover:shadow-buttonBlack transition-all duration-300'>
        <button id="createMember" class='text-h4 font-poppinsRegular text-cta-300 cursor-pointer'
        wire:click.prevent="openCreateSessionDialog()"
        >Ajouter une Séance</button>
    </div>
    <div class="grid grid-cols-2 gap-6">
        @foreach ($manager_sessions as $croc_session)
            <x-card class="flex flex-col p-6 border-2 border-cta-300 rounded-lg shadow-lg bg-background-100 hover:shadow-buttonBlack transition-all duration-300 cursor-pointer">
                <div wire:click.prevent="openUpdateSessionDialog({{$croc_session}})" class="text-mediumText font-poppinsRegular text-black text-center">
                    Session du {{ \Carbon\Carbon::parse($croc_session['sess_date'])->translatedFormat('d F Y à H:i') }}
                </div>
            </x-card>
        @endforeach
    </div>
    @livewire('create-session-dialog')
    @livewire('update-session-dialog')
</div>
