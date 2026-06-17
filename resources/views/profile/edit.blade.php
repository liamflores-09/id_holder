<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif" style="font-size: 1.875rem; font-style: italic;">{{ __('Profile') }}</h2>
    </x-slot>

    <div class="editorial-section">
        <div class="container-xl px-4 px-md-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="editorial-card">
                        <div style="max-width: 540px;">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="editorial-card mt-3">
                        <div style="max-width: 540px;">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="editorial-card mt-3">
                        <div style="max-width: 540px;">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>