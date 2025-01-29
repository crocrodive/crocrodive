@props(['session' => (object) ['sessionInitiatorName' => 'Default Name', 'sessionDate' => '01/01/1970', 'sessionUserEvaluations' => [(object) ['evaluationABilityName' => 'Default Exercise', 'evaluationRating' => 'Default Level']]]])
<x-card>
    <div class="w-[600px] h-[180px] flex flex-col py-4 gap-4 px-32">
        <div class="flex flex-row h-fit justify-between">
            <div class="text-small font-poppinsSemiBold">{{$session->sessionInitiatorName}}</div>
            <div>{{$session->sessionDate}}</div>
        </div>
        <hr class="bg-background-200 h-[2px] w-full">
        <div class="flex flex-col h-full w-full px-8">

        @php
            $evaluationColors = [
                'acquise' => 'bg-alert-success-100',
                'en cours d\'acquisition' => 'bg-alert-warning-100',
                'non évaluée' => 'border-black border-2',
                'absent' => 'bg-alert-danger-100',
                'default' => 'border-black border-2'
            ];
        @endphp

        @foreach ($session->sessionUserEvaluations as $evaluation)
        <div class="flex flex-row gap-4 items-baseline">
            <div class="h-[8px] w-[8px] rounded-cards {{ $evaluationColors[$evaluation->evaluationRating] ?? $evaluationColors['default'] }}"></div>
            <div >{{$evaluation->evaluationAbilityName}}</div>
            @if($evaluation->evaluationRating == 'absent')
                <div class="text-alert-warning-200">Absent(e)</div>
            @endif
        </div>
        @endforeach
        </div>
    </div>
</x-card>