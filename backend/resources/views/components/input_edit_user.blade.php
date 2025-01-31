@props(['type', 'name', 'placeholder', 'required', 'value'])
<div>
    <input class="rounded-cards text-h4 border-2 border-gray-300 px-4 py-2 w-full" 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}"
        value="{{ $value }}"
        @if($required)
        required
        @endif
    >
</div>