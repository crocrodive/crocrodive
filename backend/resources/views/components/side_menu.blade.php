<!-- resources/views/components/sidebar.blade.php -->
<div class="w-[287px] h-[1024px] bg-gray-100 p-4 z-0 flex">
    <ul>
        <li class="mb-4">
            <a href="{{ route('dashboard') }}" class="flex items-center text-gray-700 hover:text-gray-900">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Accueil
            </a>
        </li>
        <li class="mb-4">
            <a href="{{ route('create_user') }}" class="flex items-center text-gray-700 hover:text-gray-900">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Profil
            </a>
        </li>
        <li class="mb-4">
            <a href="{{ route('create_user') }}" class="flex items-center text-gray-700 hover:text-gray-900">
                <img src="{{asset('images/gantt-chart.png')}}" class="w-6 h-6 mr-2" alt="">
                Gestion
            </a>
        </li>
        <li class="mb-4">
            <a href="{{ route('create_user') }}" class="flex items-center text-gray-700 hover:text-gray-900">
                <img src="{{asset('images/list.png')}}" class="w-6 h-6 mr-2" alt="">
                Formation
            </a>
        </li>
    </ul>
</div>
