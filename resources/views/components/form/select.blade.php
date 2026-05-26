@props([
    'label',
    'name',
    'id' => null,
    'options' => [],
    'value' => null,
    'required' => false,
    'placeholder' => null,
    'wrapperClass' => '',
])

@php
    $inputId = $id ?? str_replace(['[', ']'], ['_', ''], $name);
    $errorKey = str_replace(['[', ']'], ['.', ''], $name);
    $errorKey = rtrim($errorKey, '.');
    $selectedValue = old($errorKey, $value);

    if ($options instanceof \Illuminate\Support\Collection) {
        $options = $options->toArray();
    }

    if (is_object($options)) {
        $options = (array) $options;
    }
@endphp

<div class="space-y-1 {{ $wrapperClass }}">
    <label for="{{ $inputId }}" class="label-text {{ $required ? 'required' : '' }}">
        {{ $label }}
    </label>

    <select id="{{ $inputId }}" name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'select ' . ($errors->has($errorKey) ? 'is-invalid' : ''),
        ]) }}
        {{ $required ? 'required' : '' }}>
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected((string) $selectedValue === (string) $optionValue)>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @error($errorKey)
        <span class="helper-text">{{ $message }}</span>
    @enderror
</div>
