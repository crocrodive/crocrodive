@props(['menuOptions'])
<div class="flex w-full  h-[104px] bg-background-100 shadow-md shadow-background-300 justify-center items-end">
    <div class=" h-fit flex flex-row gap-8">
        @foreach ($menuOptions as $option)
            <div class=" menu-option text-largeText font-poppinsSemiBold" >{{$option}}</div>
        @endforeach 
    <div>
</div>
