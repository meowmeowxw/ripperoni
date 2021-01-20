@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="text-center text-uppercase display-2 bg-success">{{$category->name}}</h3>
        <div class="row row-cols-2">
            @foreach($products as $product)
                @if($product->is_available)
                    <x-product-square :product=$product />
                @endif
            @endforeach
        </div>
    </div>
@endsection
