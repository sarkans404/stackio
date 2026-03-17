<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Stackio') - Stackio</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-[#f8f8f8] text-black dark:bg-[#0a0b0b] dark:text-white relative">
    @include('partials.header')
    @include('partials.sidebar')

    <main class="min-h-[90vh] w-full bg-[#f8f8f8] dark:bg-[#0a0b0b] pt-20 px-4">
        @yield('content')
    </main>
    <div id="notice" class="fixed right-5 bottom-5 flex flex-col gap-2">
    </div>

    @include('partials.footer')
</body>

</html>
