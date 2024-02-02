<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-black dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- ========================================================== --}}
                            <!-- Fonts -->
    {{-- ========================================================== --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- ========================================================== --}}
                            <!-- Styles -->
    {{-- ========================================================== --}}
    {{-- Compile assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])

    @yield('styles')
</head>

<body class="font-sans antialiased text-white">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        {{-- content inside this component! --}}
        @include('components.side-bar')

        <!-- Page Content -->
        {{-- <main> {{ $slot }} </main> --}}
    </div>

    {{-- ========================================================== --}}
    {{-- ====================   SCRIPTS   ========================= --}}
    {{-- ========================================================== --}}
    <script src="{{ asset('assets/js/flowbite.min.js')}} "></script>
    {{-- <script src="{{ asset('assets/js/script.js') }}"></script> --}}
    
    {{-- ========================================================== --}}
    {{-- <script> {!! Vite::content('resources/assets/js/script.js') !!} </script> --}}
    @vite('resources/assets/js/script.js')

    @yield('scripts')
</body>

</html>
