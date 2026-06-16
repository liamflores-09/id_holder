@props(['value'])

<label {{ $attributes->merge(['class' => 'label-editorial']) }}>
    {{ $value ?? $slot }}
</label>