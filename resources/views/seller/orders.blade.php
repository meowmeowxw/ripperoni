@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>{{__('Total Profit')}}: {{$totalProfit}} &euro;</h3>
                @foreach ($sellerOrders as $sellerOrder)
                    <div class="card text-center mt-3" id="customer-order.{{$sellerOrder->order}}">
                        <a href="{{route('seller.order.id', $sellerOrder->id)}}">
                            <div class="card-header d-flex flex-row">
                                <div class="mr-auto">Order Id: <strong>{{$sellerOrder->id}}</strong></div>
                                <div class="ml-auto">Total Price: <strong>{{$sellerOrder->profit}} &euro;</strong></div>
                        </div>
                        </a>
                        <div class="card-body">
                            <div class="card-text">
                                @foreach ($sellerOrder->products as $beer)
                                    <div class="row mt-4">
                                        {{--
                                        <div class="col-sm-3">
                                            <a href="{{route('product.id', $beer->id)}}"><img src="{{$beer->path}}"
                                                                                              class="card-img-top"
                                                                                              alt="{{$beer->name}}"/></a>
                                        </div>
                                        --}}
                                        <div class="col align-self-center">
                                            <x-product :product=$beer></x-product>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <h5>{{__('Current status')}}:
                                <x-status :status="$sellerOrder->status->name"></x-status>
                            </h5>
                            <a class="btn btn-primary" href="{{route('seller.order.id', $sellerOrder->id)}}">{{__('Details')}}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="justify-content-center row mt-3">
            <div class="justify-content-center">
                {!! $sellerOrders->links() !!}
            </div>
        </div>
@endsection
