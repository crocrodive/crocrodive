<x-layout>
    <div class="flex flex-row h-full w-full ">
        <div class="flex flex-col items-center w-full h-full bg-background-200">
            <pre>
            {{var_dump(Auth::user()->role_id)}}
            </pre>
        </div>
    </div>
</x-layout>
