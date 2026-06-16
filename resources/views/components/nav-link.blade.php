@props(['active' => false])

<a {{ $attributes->merge(['class' => $active ? 'inline-flex items-center px-1 pt-1 border-b border-charcoal text-xs font-medium uppercase tracking-[0.2em] text-charcoal focus:outline-none transition duration-[500ms] ease-[cubic-bezier(0.25,0.46,0.45,0.94)]' : 'inline-flex items-center px-1 pt-1 border-b border-transparent text-xs font-medium uppercase tracking-[0.2em] text-muted hover:text-charcoal hover:border-charcoal/30 focus:outline-none transition duration-[500ms] ease-[cubic-bezier(0.25,0.46,0.45,0.94)]']) }}>
    {{ $slot }}
</a>