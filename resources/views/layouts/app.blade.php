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
        <div class="min-h-screen">
            <div class="grid-lines">
                <div class="grid-line left-[25%]"></div>
                <div class="grid-line left-[50%]"></div>
                <div class="grid-line left-[75%]"></div>
            </div>

            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-charcoal/10">
                    <div class="container-editorial py-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>