@props(['active' => false])

<a {{ $attributes->merge(['class' => $active ? 'block w-full ps-3 pe-4 py-2 border-l-2 border-charcoal text-start text-xs font-medium uppercase tracking-[0.15em] text-charcoal bg-charcoal/5 focus:outline-none transition duration-[500ms] ease-[cubic-bezier(0.25,0.46,0.45,0.94)]' : 'block w-full ps-3 pe-4 py-2 border-l-2 border-transparent text-start text-xs font-medium uppercase tracking-[0.15em] text-muted hover:text-charcoal hover:border-charcoal/30 focus:outline-none transition duration-[500ms] ease-[cubic-bezier(0.25,0.46,0.45,0.94)]']) }}>
    {{ $slot }}
</a>