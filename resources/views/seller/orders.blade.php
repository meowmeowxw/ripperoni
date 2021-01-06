@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $seller->company }}</h2>
                @foreach ($products as $product)
                    <h3> {{ $product->name }} </h3>
                    @foreach ($product->orders as $order)
                        <li>{{$order->id}}: {{$order->pivot->quantity}}</li>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@endsection
