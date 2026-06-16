@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-xs text-charcoal']) }}>
        {{ $status }}
    </div>
@endif