<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Application')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Add any additional CSS files here -->
    @stack('styles')
</head>
<body>


    <main class="py-4">
        @yield('content')
    </main>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Add any additional JavaScript files here -->
    @stack('scripts')
</body>
</html>
