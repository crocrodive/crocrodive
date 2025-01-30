<div class="h-full w-full flex flex-col">
    <div class="flex w-full  h-[104px] bg-background-100 shadow-md shadow-background-300 justify-center items-end">
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

    
    @php
    $computedSessionDetails = collect($sessionsDetails)->groupBy('sess_id')->map(function ($sessions, $sess_id) {
        return (object) [
            'sessionInitiatorName' => $sessions->first()->user_firstname . ' ' . $sessions->first()->user_lastname,
            'sessionDate' => \Carbon\Carbon::parse($sessions->first()->sess_date)->format('d/m/Y'),
            'sessionUserEvaluations' => $sessions->map(function ($session) {
                return (object) [
                    'evaluationAbilityName' => $session->abil_label,
                    'evaluationRating' => $session->rati_label,
                ];
            })->toArray(),
        ];
    })->values()->toArray();
    @endphp
    <div class="flex flex-col h-full f-full p-8 gap-8 items-center">
        @if($selectedOption === 'À venir')
                @foreach ($computedSessionDetails as $session)
                    @if (\Carbon\Carbon::createFromFormat('d/m/Y', $session->sessionDate)->startOfDay() >= now()->startOfDay())
                        <x-session-card :session="$session"></x-session-card>
                    @endif
                @endforeach
        @else
                @foreach ($computedSessionDetails as $session)
                    @if (\Carbon\Carbon::createFromFormat('d/m/Y', $session->sessionDate)->startOfDay() < now()->startOfDay())
                        <x-session-card :session="$session"></x-session-card>
                    @endif
                @endforeach
        @endif
    </div>
</div>
