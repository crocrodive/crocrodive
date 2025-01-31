@props(['FirstName', 'LastName', 'PhoneNumber', 'Role', 'Level', 'Address'])
<x-card>
  <div class='flex flex-col gap-3 px-6'>
    <div class='flex flex-row justify-between font-poppinsRegular'>
      <h1 class="text-normalText">{{ $FirstName . " " . $LastName }}</h1>
      <x-bubble-role :role="$Role"/>
    </div>
    <div class='flex flex-row justify-between font-poppinsRegular'>
      <h1 class="text-normalText">{{ $PhoneNumber }}</h1>
      <h1 class="text-normalText px-2">{{ $Level }}</h1>
    </div>
    <div class='flex flex-row justify-between font-poppinsRegular'>
      <h1 class="text-normalText">{{ $Address }}</h1>
    </div>
  </div>
</x-card>