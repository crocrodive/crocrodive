@props(['session' => (object) ['sessionInitiatorName' => 'Default Name', 'sessionDate' => '01/01/1970', 'sessionUserEvaluations' => [(object) ['evaluationABilityName' => 'Default Exercise', 'evaluationRating' => 'Default Level']]]])
<x-card>
    <div class="w-[600px] h-[180px] flex flex-col py-4 gap-4 px-32">
        <div class="flex flex-row h-fit justify-between">
            <div class="text-small font-poppinsSemiBold">{{$session->sessionInitiatorName}}</div>
            <div>{{$session->sessionDate}}</div>
        </div>
        <hr class="bg-background-200 h-[2px] w-full">
        <div class="flex flex-col h-full w-full px-8">

        @foreach ($session->sessionUserEvaluations as $evaluation)
        <div class="flex flex-row gap-4  items-center">
            @if(false)
                <div class="h-[8px] w-[8px] rounded-cards bg-alert-success-100"></div> 
            @elseif(false)
                <div class="h-[8px] w-[8px] rounded-cards bg-alert-warning-100"></div>
            @else
                <div class="h-[8px] w-[8px] rounded-cards border-black border-2"></div>
            @endif
            <div>{{$evaluation->evaluationABilityName}}</div>
            @if(true)
                <div class="text-alert-warning-200">Absent(e)</div>
            @endif
        </div>
        @endforeach
        </div>
    </div>
</x-card>