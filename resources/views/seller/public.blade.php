@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h3 class="display-4 text-center text-uppercase border-bottom">{{$seller->company}}</h3>
                    <p class="lead">
                    </p>
                </div>
                @if (Auth::user()->is_seller)
                    @if (Auth::user()->seller->id === $seller->id)
                        <div class="d-flex row justify-content-center m-3">
                            <x-seller-product-new/>
                        </div>
                    @endif
                @endif
                <div class="row row-cols-md-2 justify-content-center">
                    @foreach($products as $product)
                        <x-product-square :product=$product/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
