@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($orders as $order)
                    <x-order :order="$order"/>
                @endforeach
            </div>
        </div>
        <x-paginator>
            {!! $orders->links() !!}
        </x-paginator>
    </div>
@endsection
