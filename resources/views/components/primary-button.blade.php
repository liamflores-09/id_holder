<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-editorial']) }}>
    <span>{{ $slot }}</span>
</button>