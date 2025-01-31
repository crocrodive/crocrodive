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

    <!-- Pop-up Modal -->
    <div id="createCourseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/2">
            <div class='flex flex-col gap-2 items-center'>
                <h1 class='text-h3 font-poppinsRegular'>Créer une formation</h1>
                <form class='flex flex-col gap-2'>
                    @csrf
                    <div class='grid grid-cols-2 gap-4'>
                        <label for='level' class='text-right mr-4'>Niveau :</label>
                        <select name='level' id='levelSelect' class="p-2 rounded-md">
                        </select>
                    </div>
                    <div class='grid grid-cols-2 gap-4'>
                        <label for='first_name' class='text-right mr-4'>Responsable :</label>
                        <select name='responsable' id='respSelect' class="p-2 rounded-md">
                        </select>
                    </div>
                    <div class='grid grid-cols-2 gap-4'>
                        <label for='location' class='text-right mr-4'>Lieu :</label>
                        <select name='location' id='locationSelect'  class="p-2 rounded-md">
                        </select>
                    </div>
                    <div class='grid grid-cols-2 gap-4'>
                        <div class='flex flex-col'>
                            <label for='participant' class='mr-4'>Participant</label>
                            <select name='participant' id='participantSelect' class="p-2 rounded-md">
                            </select>
                            <div id="participantList" class=''></div>
                        </div>
                        <div class='flex flex-col'>
                            <label for='trainer' class='mr-4'>Formateur</label>
                            <select name='trainer' id='trainerSelect' class="p-2 rounded-md"></select>
                            <div id="initiatorList" class=''></div>
                        </div>
                    </div>
                    <hr class="m-5">
                    <button type='reset' id="resetBtn" class='bg-gray-300 text-black py-2 px-4 rounded hover:bg-gray-400 transition-all duration-300'>Réinitialiser</button>
                    <button type='submit' id="submit" class='bg-cta-300 text-white py-2 px-4 rounded hover:bg-cta-400 transition-all duration-300'>Créer</button>
                </form>
                <button id="closeModalBtn" class="mt-4 text-red-500">Fermer</button>
            </div>
        </div>
    </div>
</x-layout>

<script>
    document.getElementById('createCourseBtn').addEventListener('click', function() {
        document.getElementById('createCourseModal').classList.remove('hidden');
    });

    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('createCourseModal').classList.add('hidden');
    });
</script>
