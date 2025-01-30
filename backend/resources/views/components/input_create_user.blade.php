@props(['type', 'name', 'placeholder', 'required', 'model'])
<div>
    <input class="rounded-cards text-h4 border-10 px-4 py-2 " 
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