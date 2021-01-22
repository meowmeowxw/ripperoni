@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            @foreach ($orders as $order)
                <x-order :order="$order"/>
            @endforeach
        </div>
    </div>
    <div class="justify-content-center row">
        <div class="justify-content-center">
            {!! $orders->links() !!}
        </div>
    </div>
@endsection
