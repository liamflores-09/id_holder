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

        @include('layouts.navigation')

        @isset($header)
            <div class="page-header">
                <div class="container-xl py-4 px-4 px-md-5">
                    {{ $header }}
                </div>
            </div>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </body>
</html>