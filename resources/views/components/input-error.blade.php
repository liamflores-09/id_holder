@props(['messages'])

@if ($messages)
    <div {{ $attributes->merge(['class' => 'error-text']) }}>
        @foreach ((array) $messages as $message)
            <div>{{ $message }}</div>
        @endforeach
    </div>
@endif