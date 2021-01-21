@extends('layouts.app')

@section('styles')
    <style>
        .jumbotron {
            background-color: #f4b0af;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h3 class="text-center text-uppercase">{{$category->name}}</h3>
                    <p>
                        {{$category->description}}
                    </p>
                </div>
                <div class="row row-cols-md-2 justify-content-center">
                    @foreach($products as $product)
                        @if($product->is_available)
                            <x-product-square :product=$product />
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
