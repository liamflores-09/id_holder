<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif text-3xl italic text-charcoal">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="section-light">
        <div class="container-editorial space-y-12">
            <div class="card-editorial">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card-editorial">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card-editorial">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>