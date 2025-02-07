@props(['type', 'name', 'placeholder', 'required', 'model'])
<div>
    <input class="rounded-cards text-h4 border-2 border-gray-300 px-4 py-2 w-full" 
        wire:model="{{ $model }}"
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}"
        @if($required)
        required
        @endif
    >
</div>