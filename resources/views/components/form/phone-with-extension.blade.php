@props([
    'label',
    'phoneName' => 'phone_number',
    'extensionName' => 'phone_extension',
    'phoneValue' => null,
    'extensionValue' => null,
    'id' => null,
])

@php
    // IDs
    $phoneId = $id ?? str_replace(['[', ']'], ['_', ''], $phoneName);
    $extensionId = str_replace(['[', ']'], ['_', ''], $extensionName);

    // Error keys (dot notation)
    $phoneErrorKey = rtrim(str_replace(['[', ']'], ['.', ''], $phoneName), '.');
    $extensionErrorKey = rtrim(str_replace(['[', ']'], ['.', ''], $extensionName), '.');
@endphp

<div class="space-y-1">
    <label class="label-text" for="{{ $phoneId }}">
        {{ $label }}
    </label>

    <div class="join w-full">
        <input type="text" id="{{ $phoneId }}" name="{{ $phoneName }}"
            class="input join-item {{ $errors->has($phoneErrorKey) ? 'is-invalid' : '' }}"
            value="{{ old($phoneErrorKey, $phoneValue) }}" onkeypress="return isNumberKey(event);" />

        <input type="text" id="{{ $extensionId }}" name="{{ $extensionName }}" placeholder="Extn."
            class="input join-item !w-20 {{ $errors->has($extensionErrorKey) ? 'is-invalid' : '' }}"
            value="{{ old($extensionErrorKey, $extensionValue) }}" onkeypress="return isNumberKey(event);" />
    </div>

    @error($phoneErrorKey)
        <span class="helper-text">{{ $message }}</span>
    @enderror

    @error($extensionErrorKey)
        <span class="helper-text">{{ $message }}</span>
    @enderror
</div>
