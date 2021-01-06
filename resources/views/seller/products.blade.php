@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>{{ $seller->company }}</h3>
                @foreach ($products as $product)
                    <x-seller-product>
                        <x-slot name="path">
                            {{ $product->path }}
                        </x-slot>
                        <x-slot name="title">
                            {{ $product->name }}
                        </x-slot>
                        <x-slot name="id">
                            {{ $product->id }}
                        </x-slot>
                        <x-slot name="name">
                            {{ $product->name }}
                        </x-slot>
                        <x-slot name="description">
                            {{ $product->description }}
                        </x-slot>
                        <x-slot name="price">
                            {{ $product->price }}
                        </x-slot>
                        <x-slot name="quantity">
                            {{ $product->quantity }}
                        </x-slot>
                        {{ $product->quantity }}
                    </x-seller-product>
                @endforeach
            </div>
        </div>
    </div>
@endsection
