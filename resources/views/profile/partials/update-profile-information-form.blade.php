@props(['value'])

<section>
    <header>
        <h2 class="font-serif" style="font-size: 1.25rem; font-style: italic;">{{ __('Profile Information') }}</h2>
        <p class="mt-1" style="font-size: 0.75rem; color: var(--muted); line-height: 1.6;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="d-block w-100" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="d-block w-100" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p style="font-size: 0.75rem; color: var(--muted);">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="editorial-link text-decoration-underline border-0 bg-transparent p-0" style="letter-spacing: normal;">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p style="font-size: 0.75rem; font-weight: 500;" class="mt-1">{{ __('A new verification link has been sent to your email address.') }}</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" style="font-size: 0.75rem; color: var(--muted);">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>