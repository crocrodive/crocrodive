@props(['menuOptions'])
<div class="flex w-full  h-[104px] bg-background-100 shadow-md shadow-background-300 justify-center items-end">
    <div class=" h-fit flex flex-row gap-8">
        @foreach ($menuOptions as $option)
            <div  id="{{$option}}" class="text-largeText font-poppinsSemiBold" >{{$option}}</div>
        @endforeach 
    <div>
</div>
<script>
    let selectedStyle = {
        color: '#6534CD',
        textDecoration: 'underline'
    };
    let defaultStyle = {
        color: '#000000',
        textDecoration: 'none'
    };



    const menuOptions = @json($menuOptions);
    menuOptions.forEach(option => {
        document.getElementById(option).addEventListener('click', () => {
            menuOptions.forEach(option => {
                document.getElementById(option).style.color = defaultStyle.color;
                document.getElementById(option).style.textDecoration = defaultStyle.textDecoration;
            });
            document.getElementById(option).style.color = selectedStyle.color;
            document.getElementById(option).style.textDecoration = selectedStyle.textDecoration;
            
             
        });
    });

</script>