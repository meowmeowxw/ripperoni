@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $seller->company }}</h2>
                @foreach ($products as $product)
                    <li>{{$product->name}}</li>
                @endforeach
            </div>
        </div>
    </div>
@endsection
