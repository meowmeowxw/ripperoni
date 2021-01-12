@extends('layouts.app')

@section('content')
    @isset($final_order)
        {{--
        @php
        dd($products_order);
        @endphp
        --}}
        @php
            // dd($products_order);
            // $a = $products_order->contains('product_id');
            // dd($final_order);
        @endphp
        @foreach ($final_order as $fo)
            <li> {{ $fo["total_price"] }} : {{ $fo["ordered_quantity"] }}  </li>
        @endforeach
        <a href="{{route('customer.cart.details')}}">{{__('Proceed')}}</a>
    @endisset

@endsection
