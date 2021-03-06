<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        <x-guest.header>
            <a href="/">
                <x-application-logo class="w-24 h-12 fill-current text-gray-500" />
            </a>
        </x-guest.header>

        {{ $slot }}

        <x-guest.footer>
            <p class="m-0 text-center">Build with &#10084;. {{ now()->format('Y') }} all rights reserved.</p>
        </x-guest.footer>
    </div>
</body>

</html>
