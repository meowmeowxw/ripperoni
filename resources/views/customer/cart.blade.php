@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($final_order)
                    <div class="card mt-3" id="customer-cart">
                        <div class="card-header d-flex flex-row">
                            {{__('Total price')}}: {{ $total_price }}
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
                                                    = {{ $fo["total_price"] }} &euro;
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    @php
                                                        $seller = $product->seller;
                                                    @endphp
                                                    sell by <a
                                                        href="{{route('seller.id', $seller->id)}}">{{ $seller->company }}</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                               <div class="col">
                                                   <form id="{{'delete'.$product->id}}" action="{{route('customer.cart.delete-product')}}" method="POST">
                                                       @csrf
                                                       <input id="{{'product'.$product->id}}" value="{{$product->id}}" name="id"
                                                              type="hidden">
                                                   </form>
                                                   <a href="#"
                                                      onclick="document.getElementById('{{"delete".$product->id}}').submit();">{{__('Delete')}}</a>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-3">
                                    <a class="btn btn-primary btn-block"
                                       href="{{route('customer.cart.details')}}">{{__('Proceed')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{__('The cart is empty')}}
                @endisset
            </div>
        </div>
    </div>

@endsection
