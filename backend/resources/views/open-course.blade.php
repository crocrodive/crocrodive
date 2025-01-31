<x-layout>
  <div class='flex flex-col justify-center items-center py-8'>
    <h1 class="font-poppinsRegular text-h4">Informations sur la Formation</h1>
    <div class='flex flex-col py-4 gap-4'>
      <div class='grid grid-cols-2 gap-2'>
        <h1 class='font-PoppinsRegular text-normalText'>Responsable :</h1>
        <div class='bg-background-150 rounded-button flex flex-row items-center justify-center'>
          <h1 class='font-PoppinsRegular text-normalText' id="resp">{{$resp['manager']['user_firstname'] . " " . $resp['manager']['user_lastname']}}</h1>
        </div>
      </div>
      <div class='grid grid-cols-2 gap-2'>
        <h1 class='font-PoppinsRegular text-normalText'>Site :</h1>
        <div class='bg-background-150 rounded-button flex flex-row items-center justify-center'>
          <h1 class='font-PoppinsRegular text-normalText' id="location">{{$resp['manager']['site_name']}}</h1>
        </div>
      </div>
      <div class='grid grid-cols-2 gap-2'>
        <h1 class='font-PoppinsRegular text-normalText'>Niveau :</h1>
        <div class='bg-background-150 rounded-button flex flex-row items-center justify-center'>
          <h1 class='font-PoppinsRegular text-normalText' id="level">{{$resp['manager']['leve_name']}}</h1>
        </div>
      </div>
      <div class='flex flex-row gap-16'>
        <div class='flex flex-col'>
          <h1 class='font-PoppinsRegular text-normalText'>Participants</h1>
          <div class='bg-background-300 rounded-xl flex flex-row h-16 w-32 p-2' id="participantList">
            @foreach ($students as $student)
              <h1 class='font-PoppinsRegular text-normalText'>{{ $student['user_firstname'] . " " . $student['user_lastname'] }}</h1>
            @endforeach
          </div>
        </div>
        <div class='flex flex-col'>
          <h1 class='font-PoppinsRegular text-normalText'>Initiateurs</h1>
          <div class='bg-background-300 rounded-xl flex flex-row h-16 w-32 p-2' id="trainerList">
            @foreach ($trainers as $trainer)
              <h1 class='font-PoppinsRegular text-normalText'>{{ $trainer['user_firstname'] . " " . $trainer['user_lastname'] }}</h1>
            @endforeach
          </div>
        </div>
      </div>
      <div class='flex flex-row justify-center border-2 border-cta-300 w-[272px] h-12 rounded-button items-center
        bg-background-100 hover:shadow-buttonBlack transition-all duration-300'>
            <button id="createCourseBtn" class='text-h4 font-poppinsRegular text-cta-300 cursor-pointer'>Modifier une formation</button>
        </div>
    </div>
  </div>
</x-layout>