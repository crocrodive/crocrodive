@vite(['resources/js/createCourse.js'])

<x-layout>
    <div class='flex flex-col items-center p-8 gap-8' id="listCourse">
        <div class='flex flex-row justify-center border-2 border-cta-300 w-[272px] h-12 rounded-button items-center
        bg-background-100 hover:shadow-buttonBlack transition-all duration-300'>
            <button id="createCourseBtn" class='text-h4 font-poppinsRegular text-cta-300 cursor-pointer'>Créer une formation</button>
        </div>
        <x-list>
        @foreach ($all_course_value as $course)
            <x-course-card :first_name="$course['user_firstname']" :last_name="$course['user_lastname']" :start_date="$course['cour_start_date']" :leve_name="$course['leve_name']" :site_name="$course['site_name']" :course_id="$course['cour_id']"/>
        @endforeach
        </x-list>
    </div>
    <div class='flex flex-col gap-2 items-center' style="display: none;" id="createCourse">
        <h1 class='text-h3 font-poppinsRegular'>Créer une formation</h1>
        <form class='flex flex-col gap-2'>
            @csrf
            <div class='grid grid-cols-2'>
                <label for='level'>Niveau</label>
                <select name='level' id='levelSelect'>
                    <option value='' selected></option>
                </select>
            </div>
            <div class='grid grid-cols-2'>
                <label for='first_name'>Responsable</label>
                <select name='responsable' id='respSelect'>
                    <option value='' selected></option>
                </select>
            </div>
            <div class='grid grid-cols-2'>
                <label for='location'>Lieu</label>
                <select name='location' id='locationSelect'>
                    <option value='' selected></option>
                </select>
            </div>
            <div class='grid grid-cols-2 gap-4'>
                <div class='flex flex-col'>
                    <select name='participant' id='participantSelect'>
                        <option value='' selected></option>
                    </select>
                    <div id="participantList" class=''></div>
                </div>
                <div class='flex flex-col'>
                    <select name='trainer' id='trainerSelect'></select>
                    <div id="initiatorList" class=''></div>
                </div>
            </div>
            <input type='submit' id="submit" value='Créer'>
        </form>
    </div>
</x-layout>
