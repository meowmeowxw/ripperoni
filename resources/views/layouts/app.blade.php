<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ripperoni') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/search.js') }}" defer></script>
    @yield('scripts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/img-box.css') }}" rel="stylesheet">
    <link href="{{ asset('css/page.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>

<header>
    <x-nav-bar/>
</header>
<div id="app">
    <main class="p-2">
        @yield('content')
    </main>
</div>

<footer id="footer" class="footer fixed-bottom text-center">
    <div class="text-center p-3">
        © 2021 Copyright:
        <a class="text-dark" href="{{config('app.url', 'http://localhost')}}">{{ config('app.name', 'Ripperoni') }}</a>
    </div>
</footer>

</body>

</html>
