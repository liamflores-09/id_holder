@props(['value'])

<label {{ $attributes->merge(['class' => 'editorial-label']) }}>
    {{ $value ?? $slot }}
</label>