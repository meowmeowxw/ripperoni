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
    @yield('styles')

</head>
<body>

<header>
    <x-nav-bar/>
</header>
<div id="app">
    {{--

    @php
   $allpath = \App\Models\Product::select('path')->get()
@endphp

    style="background-image:
@foreach($allpath as $path)
@if($loop->last)
   url({{substr($path->path, 1)}});
@else
   url({{substr($path->path, 1)}}),
@endif
@endforeach
   background-repeat: space fixed; background-size: 50px;"
    --}}



    <main class="p-2">
        @yield('content')
    </main>
</div>
{{--
<footer class="text-muted bg-dark">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
        <p>Album example is © Bootstrap, but please download and customize it for yourself!</p>
        <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
    </div>
</footer>
--}}
</body>
</html>
