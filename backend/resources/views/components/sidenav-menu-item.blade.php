@props(['pageName', 'page', 'imageName', 'active' => false])

<style>svg{width: 100%; height: 100%;}</style>

<div class='flex flex-row gap-6 m-4 items-center'>
    <div class='h-12 w-12'>
        @if($imageName)
            {!! file_get_contents(Vite::asset('resources/icons/dynamic/'.$imageName .'.svg')) !!}
        @endif
    </div>
    @if($active)
        <a href={{"/".$page}} class="text-h4 font-poppinsSemiBold ">{{$pageName}}</a>
    @else
        <a href="{{"/".$page}}" class="text-h4 font-poppinsRegular ">{{$pageName}}</a>
    @endif
</div>