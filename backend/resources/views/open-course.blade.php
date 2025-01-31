<x-layout>
  <div class='flex flex-col justify-center items-center py-8'>
    <h1 class="font-poppinsRegular text-h4 mb-6">Informations sur la Formation</h1>
    <div class='flex flex-col py-4 gap-6 w-full max-w-4xl items-center'>
      <div class='grid grid-cols-2 gap-4 items-center'>
        <h1 class='font-PoppinsRegular text-normalText text-right'>Responsable :</h1>
        <div class='bg-background-150 rounded-button flex flex-row items-center justify-center p-2 w-[200px] hover:shadow-buttonHover transition-all'>
          <h1 class='font-PoppinsRegular text-normalText' id="resp">{{$resp['manager']['user_firstname'] . " " . $resp['manager']['user_lastname']}}</h1>
        </div>
      </div>
      <div class='grid grid-cols-2 gap-4 items-center'>
        <h1 class='font-PoppinsRegular text-normalText text-right'>Site :</h1>
        <div class='bg-background-150 rounded-button flex flex-row items-center justify-center p-2 w-[200px] hover:shadow-buttonHover transition-all'>
          <h1 class='font-PoppinsRegular text-normalText' id="location">{{$resp['manager']['site_name']}}</h1>
        </div>
      </div>
      <div class='grid grid-cols-2 gap-4 items-center'>
        <h1 class='font-PoppinsRegular text-normalText text-right'>Niveau :</h1>
        <div class='bg-background-150 rounded-button flex flex-row items-center justify-center p-2 w-[200px] hover:shadow-buttonHover transition-all'>
          <h1 class='font-PoppinsRegular text-normalText' id="level">{{$resp['manager']['leve_name']}}</h1>
        </div>
      </div>
      <div class='flex flex-row gap-16'>
        <div class='flex flex-col'>
          <h1 class='font-PoppinsRegular text-normalText mb-2'>Participants</h1>
          <div class='bg-background-300 rounded-xl flex flex-col h-[200px] w-48 p-4 overflow-y-auto' id="participantList">
            @foreach ($students as $student)
              <h1 class='font-PoppinsRegular text-normalText mb-1'>{{ $student['user_firstname'] . " " . $student['user_lastname'] }}</h1>
            @endforeach
          </div>
        </div>
        <div class='flex flex-col'>
          <h1 class='font-PoppinsRegular text-normalText mb-2'>Initiateurs</h1>
          <div class='bg-background-300 rounded-xl flex flex-col h-[200px] w-48 p-4 overflow-y-auto' id="trainerList">
            @foreach ($trainers as $trainer)
              <h1 class='font-PoppinsRegular text-normalText mb-1'>{{ $trainer['user_firstname'] . " " . $trainer['user_lastname'] }}</h1>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>