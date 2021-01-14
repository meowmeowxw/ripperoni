@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-md-8">
            <h2>You have done {{ count($orders) }} orders</h2>
            @foreach ($orders as $order)
                <x-order :order=$order/>
            @endforeach
        </div>
    </div>
@endsection
