<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-editorial-outline', 'style' => 'border-color: #dc3545; color: #dc3545;']) }}>
    {{ $slot }}
</button>