@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>{{__('Total Profit')}}: {{$total_profit}} &euro;</h3>
                @foreach ($orders as $order)
                    <h4>{{__('Order ID')}}: {{ $order['id'] }}</h4>
                    @foreach ($order['products'] as $product)
                        <li>{{$product->name}}: {{$product->pivot->ordered_quantity}}</li>
                    @endforeach
                    <h5>{{__('Earning')}}: {{$order['earning']}}</h5>
                @endforeach
            </div>
        </div>
    </div>
@endsection
