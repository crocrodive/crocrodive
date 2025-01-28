<x-layout>
    <div class="flex flex-row ">
       <x-sideNav/>
        <div class="flex flex-col items-center w-full h-full bg-background-200">
            {{-- user type --}}
            @if (true) 
                <x-menu :menuOptions="['Passée','À venir']" />
                @if(true)
                    <div>here</div>
                @else
                    <div>there</div>
                @endif
            @endif
        </div>
    </div>
</x-layout>

<script>
    let selectedStyle = {
        color: '#6534CD',
        textDecoration: 'underline'
    };
    let defaultStyle = {
        color: '#000000',
        textDecoration: 'none'
    };

    let selectedMenuOption = 'À venir';
    Object.assign(document.getElementById(selectedMenuOption).style, selectedStyle);



    const menuOptions = @json(['Passée','À venir']);
    menuOptions.forEach(option => {
        document.getElementById(option).addEventListener('click', () => {
            selectedMenuOption = option;
            menuOptions.forEach(option => {
                Object.assign(document.getElementById(option).style, defaultStyle);
            });
            Object.assign(document.getElementById(option).style, selectedStyle);
        });
    });
</script>