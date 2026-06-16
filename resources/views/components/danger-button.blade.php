<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-charcoal border border-charcoal text-gallery text-xs font-medium uppercase tracking-[0.2em] hover:bg-charcoal/80 focus:outline-none transition duration-[500ms] ease-[cubic-bezier(0.25,0.46,0.45,0.94)]']) }}>
    {{ $slot }}
</button>