@extends('layouts.app')
@section('content')
    <div class="container" id="dashboard">
        <div class="row justify-content-center no-gutters">
                <h3>The latest beer added</h3>
            <div class="d-flex flex-row d-sm-inline-flex flex-sm-row">
                @php
                $homebeers = \App\Models\Product::orderBy('created_at', 'DESC')->take(3)->get();
                @endphp
                <x-public.home-beer :beer=$homebeers[0] class="d-block"/>
                <x-public.home-beer :beer=$homebeers[1] class="d-none d-md-block"/>
                <x-public.home-beer :beer=$homebeers[2] class="d-none d-lg-block"/>
            </div>

            @foreach($categories as $category=>$products)
                <section>
                    <h2> {{ $category }} </h2>
                    @foreach($products as $product)
                        <li>
                            <b>{{ $product->name }}</b>: {{ $product->description }}
                        </li>
                    @endforeach
                </section>
            @endforeach

        </div>
        <div class="row">

            You're logged in!
        </div>
    </div>
@endsection
