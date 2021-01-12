@extends('layouts.app')

@section('content')
    @isset($products_order)
        {{--
        @php
        dd($products_order);
        @endphp
        --}}
        @php
            // dd($products_order);
            // $a = $products_order->contains('product_id');
            // dd($a);
        @endphp
        @foreach ($products_order->all() as $po)
            <li> {{ $po["product_id"] }} : {{ $po["ordered_quantity"] }}  </li>
        @endforeach
    @endisset
@endsection
