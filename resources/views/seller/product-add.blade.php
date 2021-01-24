@extends('layouts.app')

@section('content')
    <div class="container py-2">
        <div class="row justify-content-center">
            <x-seller-product-new/>
        </div>
        <div class="row justify-content-center mt-3">
            <a id="products" class="btn btn-primary btn-lg" href="{{route('seller.id', Auth::user()->seller->id)}}">
                {{__('My Products')}}
            </a>
        </div>
    </div>
@endsection
