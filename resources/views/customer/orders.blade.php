@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col" style="max-width: 768px;">
                @foreach ($orders as $order)
                    <x-order :order="$order"/>
                @endforeach
            </div>
        </div>
        <div class="justify-content-center row mt-2">
            <div class="justify-content-center">
                {!! $orders->links() !!}
            </div>
        </div>
    </div>
@endsection
