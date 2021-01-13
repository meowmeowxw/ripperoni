@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>{{__('Total Profit')}}: {{$total_profit}} &euro;</h3>
                @foreach ($orders as $order)
                <div class="card mt-3" id="customer-order.{{$order['id']}}">
                    <div class="card-header d-flex flex-row">
                        <div class="mr-auto">Order Id: <strong>{{$order['id']}}</strong></div>
                        <div class="ml-auto">Total Price: <strong>{{$order['profit']}} &euro;</strong></div>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            @foreach ($order['products'] as $beer)
                                <div class="row mt-4">
                                    <div class="col-sm-3">
                                        <a href="{{route('product.id', $beer->id)}}"><img src="{{$beer->path}}" class="card-img-top" alt="{{$beer->name}}"/></a>
                                    </div>
                                    <div class="col align-self-center">
                                        <x-public.product :product=$beer :sellBy="TRUE"></x-public.product>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
