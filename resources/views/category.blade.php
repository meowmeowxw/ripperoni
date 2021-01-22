@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h3 class="display-4 text-center text-uppercase border-bottom">{{$category->name}}</h3>
                    <p class="lead">
                        {{$category->description}}
                    </p>
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
