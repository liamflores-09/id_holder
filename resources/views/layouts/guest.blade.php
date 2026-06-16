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
    <body class="font-sans bg-gallery text-charcoal antialiased">
        <div class="min-h-screen flex flex-col">
            <div class="grid-lines">
                <div class="grid-line left-[25%]"></div>
                <div class="grid-line left-[50%]"></div>
                <div class="grid-line left-[75%]"></div>
            </div>

            <div class="flex-1 flex items-center justify-center py-16 md:py-24">
                <div class="w-full max-w-md px-8">
                    <div class="mb-12">
                        <a href="/" class="block">
                            <span class="font-serif text-2xl italic text-charcoal">ID Holder</span>
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>

            <footer class="border-t border-charcoal/10 py-8">
                <div class="container-editorial text-center">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-muted">&copy; {{ date('Y') }} ID Holder</span>
                </div>
            </footer>
        </div>
    </body>
</html>