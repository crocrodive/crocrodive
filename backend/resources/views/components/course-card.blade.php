@props(['first_name', 'last_name', 'start_date', 'leve_name', 'site_name', 'course_id'])

<a class='' id="openCourse" href="/course/{{ $course_id }}">
  <x-card>
    <div class='flex flex-col px-6'>
      <div class='flex flex-col'>
        <div class='flex flex-row justify-between font-poppinsRegular'>
          <h1 class="text-normalText font-poppinsSemiBold">{{ $first_name . " " . $last_name }}</h1>
          <h1 class='text-normalText'>{{ $start_date }}</h1>
        </div>
        <x-divider />
      </div>
      <div class='flex flex-col gap-4'>
        <div class='flex flex-row justify-between font-poppinsRegular'>
          <h1 class="text-normalText">Niveau {{ $leve_name }}</h1>
        </div>
        <div class='flex flex-row gap-2 font-poppinsRegular items-stretch'>
          <div class='h-6 w-6 text-red-500'>
            {!! file_get_contents(Vite::asset('resources/icons/location-icon.svg')) !!}
          </div>
          <h1 class="text-normalText">{{ $site_name }}</h1>
          </div>
        </div>
      </div>
  </x-card>
</a>


<style>svg{width: 100%; height: 100%;}</style>