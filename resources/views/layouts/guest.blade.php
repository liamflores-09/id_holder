<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ID Holder') }}</title>

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,300;0,400;1,300;1,400&family=Inter:wght@400;500&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="grid-lines">
            <div class="grid-line" style="left: 25%"></div>
            <div class="grid-line" style="left: 50%"></div>
            <div class="grid-line" style="left: 75%"></div>
        </div>

        <div class="d-flex flex-column min-vh-100">
            <div class="flex-grow-1 d-flex align-items-center py-5">
                <div class="container" style="max-width: 420px;">
                    <div class="mb-5">
                        <a href="/" class="text-decoration-none">
                            <span class="font-serif" style="font-size: 1.5rem; font-style: italic; color: var(--charcoal);">ID Holder</span>
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>

            <footer style="border-top: 1px solid var(--border);" class="py-4">
                <div class="container-xl text-center">
                    <span class="editorial-text">&copy; {{ date('Y') }} ID Holder</span>
                </div>
            </footer>
        </div>
    </body>
</html>