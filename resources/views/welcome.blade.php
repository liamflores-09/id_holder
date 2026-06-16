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
    <body class="font-sans bg-gallery text-charcoal antialiased">
        <div class="min-h-screen flex flex-col">
            <div class="grid-lines">
                <div class="grid-line left-[25%]"></div>
                <div class="grid-line left-[50%]"></div>
                <div class="grid-line left-[75%]"></div>
            </div>

            <header class="container-editorial py-6">
                @if (Route::has('login'))
                    <nav class="flex items-center justify-end gap-8">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-secondary">
                                <span>Dashboard</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-xs font-medium uppercase tracking-[0.2em] text-muted hover:text-charcoal transition-colors duration-[500ms]">
                                {{ __('Log in') }}
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary">
                                    <span>{{ __('Register') }}</span>
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="flex-1 flex items-center">
                <div class="container-editorial w-full py-24 md:py-32">
                    <div class="grid md:grid-cols-2 gap-16 md:gap-24 items-center">
                        <div>
                            <div class="decorative-line mb-8"></div>

                            <p class="text-[10px] font-medium uppercase tracking-[0.3em] text-muted mb-6">
                                Digital Identity Management
                            </p>

                            <h1 class="font-serif text-5xl md:text-7xl leading-[0.9] text-charcoal mb-8">
                                <span class="italic">Secure</span><br>
                                Your Identity
                            </h1>

                            <p class="text-muted leading-relaxed max-w-md mb-12">
                                Store and manage your digital identification documents with elegance and security.
                                National IDs, passports, and driver's licenses — all in one refined space.
                            </p>

                            <div class="flex gap-4">
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary">
                                        <span>{{ __('Get Started') }}</span>
                                    </a>
                                @endif

                                @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="btn-secondary">
                                        <span>{{ __('Sign In') }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="relative">
                            <div class="aspect-[3/4] bg-surface flex items-center justify-center image-card">
                                <div class="text-center p-12">
                                    <div class="font-serif text-6xl italic text-charcoal/10 mb-4">
                                        ID
                                    </div>
                                    <p class="text-[10px] uppercase tracking-[0.3em] text-muted">
                                        Your Documents
                                    </p>
                                </div>
                            </div>
                            <div class="absolute -bottom-4 -right-4 w-full h-full border border-charcoal/10 -z-10"></div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="border-t border-charcoal/10 py-8">
                <div class="container-editorial flex justify-between items-center">
                    <span class="font-serif italic text-sm text-charcoal">ID Holder</span>
                    <span class="text-[10px] uppercase tracking-[0.3em] text-muted">&copy; {{ date('Y') }}</span>
                </div>
            </footer>
        </div>
    </body>
</html>