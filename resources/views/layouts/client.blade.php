<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'FoodApp')</title>
    @vite(['resources/css/app.css', 'resources/css/client/app.css', 'resources/js/app.js'])
    @vite(['resources/css/client/home.css'])
    @livewireStyles
    @stack('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    @include('client.partials.navbar')
    <header class="bg-white border-bottom">
    </header>
    <main class="container my-4 flex-grow-1">
        @yield('content')
        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
    @include('client.partials.footer')
    @livewireScripts
    @stack('scripts')
</body>

</html>
