@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($final_order)
                    <div class="card mt-3" id="customer-cart">
                        <div class="card-header d-flex flex-row">
                            {{__('Details')}}
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                @foreach ($final_order as $fo)
                                    @php
                                    $product = $fo["product"];
                                    @endphp
                                    <div class="row mt-4">
                                        <div class="col-sm-3">
                                            <a href="{{route('product.id', $product->id)}}"><img
                                                    src="{{$product->path}}"
                                                    class="card-img-top"
                                                    alt="{{$product->name}}"/></a>
                                        </div>
                                        <div class="col align-self-center">
                                            <p class="m-0">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="{{route('product.id', $product->id)}}"><strong>{{ $product->name }}</strong></a>
                                                </div>
                                                <div class="col">
                                                    {{ $fo["ordered_quantity"] }} x
                                                    {{ $fo["single_price"] }} &euro;
                                                    = {{ $fo["total_price"] }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    @php
                                                        $seller = \App\Models\Seller::find($product->seller_id);
                                                    @endphp
                                                    sell by <a
                                                        href="{{route('seller.id', $seller->id)}}">{{ $seller->company }}</a>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a class="btn btn-primary" href="{{route('customer.cart.details')}}">{{__('Proceed')}}</a>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>

@endsection
