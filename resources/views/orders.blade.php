@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Hey {{$user->name}}</h1>
            <h2>Your orders:</h2>
                <div class="col-md-8">
                    @foreach ($orders as $order)
                        <x-user.customer-order :order=$order />
                    @endforeach
                </div>
            </div>
        </div>
@endsection
