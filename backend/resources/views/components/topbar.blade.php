<!-- resources/views/components/top-bar.blade.php -->
<div class="flex items-center justify-between bg-white text-white p-4 shadow-md z-10">
    <div class="flex items-center">
        <div class="relative">
            <button id="dropdownButton" class="flex items-center focus:outline-none">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
            <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                <img src="{{ asset('/images/utilisateur.png') }}" class="w-4 h-4" alt="Utilisateur">
            </div>
        </div>
    </div>
    <div class="flex items-center">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
    </div>
</div>