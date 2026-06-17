<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'ID Holder') }}</title>

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,300;0,400;1,300;1,400&family=Inter:wght@400;500&display=swap" rel="stylesheet">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <div class="grid-lines">
            <div class="grid-line" style="left: 25%"></div>
            <div class="grid-line" style="left: 50%"></div>
            <div class="grid-line" style="left: 75%"></div>
        </div>

        <header class="container-xl px-4 px-md-5 py-4">
            @if (Route::has('login'))
                <nav class="d-flex justify-content-end gap-4 align-items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-editorial"><span>Dashboard</span></a>
                    @else
                        <a href="{{ route('login') }}" class="editorial-link" style="letter-spacing: normal;">{{ __('Log in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-editorial"><span>{{ __('Register') }}</span></a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-grow-1 d-flex align-items-center">
            <div class="container-xl px-4 px-md-5 py-5">
                <div class="row align-items-center g-5">
                    <div class="col-md-6">
                        <div class="editorial-divider mb-4"></div>
                        <p class="editorial-text mb-3">Digital Identity Management</p>
                        <h1 class="font-serif mb-4" style="font-size: 3rem; line-height: 0.9; font-style: italic;">
                            <span>Secure</span><br>
                            Your Identity
                        </h1>
                        <p style="color: var(--muted); line-height: 1.6; max-width: 400px;" class="mb-4">
                            Store and manage your digital identification documents with elegance and security.
                            National IDs, passports, and driver's licenses — all in one refined space.
                        </p>
                        <div class="d-flex gap-3">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-editorial"><span>{{ __('Get Started') }}</span></a>
                            @endif
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn-editorial-outline"><span>{{ __('Sign In') }}</span></a>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 position-relative">
                        <div class="image-card" style="aspect-ratio: 3/4; background: var(--surface); display: flex; align-items: center; justify-content: center;">
                            <div class="text-center p-4">
                                <div class="font-serif" style="font-size: 4rem; font-style: italic; color: rgba(17,17,17,0.1);">ID</div>
                                <p class="editorial-text">Your Documents</p>
                            </div>
                        </div>
                        <div style="position: absolute; bottom: -16px; right: -16px; width: 100%; height: 100%; border: 1px solid var(--border); z-index: -1;"></div>
                    </div>
                </div>
            </div>
        </main>

        <footer style="border-top: 1px solid var(--border);" class="py-4">
            <div class="container-xl px-4 px-md-5 d-flex justify-content-between align-items-center">
                <span class="font-serif" style="font-size: 0.875rem; font-style: italic;">ID Holder</span>
                <span class="editorial-text">&copy; {{ date('Y') }}</span>
            </div>
        </footer>
    </body>
</html>