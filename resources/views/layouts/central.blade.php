<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/js/app_teanet.js'])

    <!-- Styles -->
    @vite(['resources/css/app.css'])

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen antialiased font-sans">
    <nav class="bg-gray-900 py-2">
        <div class="container mx-auto flex justify-between">
            <div>
                <a href="{{ route('central.landing') }}" class="block py-2 px-4 text-white font-medium">
                    Home
                </a>
            </div>
            <div class="flex">
                <x-button as="a" href="{{ route('central.tenants.login') }}">Login</x-button>
                <x-button class="ml-2" as="a" href="{{ route('central.tenants.register') }}">Register</x-button>
            </div>
        </div>
    </nav>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 min-h-screen bg-gray-100">
        <div class="py-10">
            <main class="container mx-auto">
                <div class="max-w-7xl sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
  </div>
</body>
</html>
