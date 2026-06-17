@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert-editorial']) }}>
        {{ $status }}
    </div>
@endif