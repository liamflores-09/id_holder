<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl italic text-charcoal">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="section-light">
        <div class="container-editorial">
            <div class="card-editorial">
                <p class="font-serif text-lg italic text-charcoal">
                    {{ __("You're logged in!") }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>