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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
{{--
@php
    $allpath = \App\Models\Product::select('path')->get()
@endphp
--}}

<div id="app"
     {{--
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
>

    <x-nav-bar/>

    <main class="m-4">
        @yield('content')
    </main>
</div>
</body>
</html>
