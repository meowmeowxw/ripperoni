@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $seller->company }}</h2>
                @foreach ($products as $product)
                    <x-seller-product>
                        <x-slot name="path">
                            {{ $product->path }}
                        </x-slot>
                        <x-slot name="title">
                            {{ $product->name }}
                        </x-slot>
                        {{ $product->quantity }}
                    </x-seller-product>
                @endforeach
            </div>
        </div>
    </div>
@endsection
