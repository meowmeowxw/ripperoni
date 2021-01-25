@extends('layouts.app')

@section('content')
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col text-center">
                <div class="jumbotron py-4">
                    @isset($products)
                    <h3 class="text-center text-uppercase border-bottom">{{__('Search Result')}}</h3>
                    <p class="lead">
                        {{count($products)}}
                    </p>
                    @endisset
                </div>
                <div class="row row-cols-md-2 justify-content-center">
                    @foreach($products as $product)
                        <x-product-square :product=$product/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
