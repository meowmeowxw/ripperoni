@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($products as $product)
                    @if ($product->is_available)
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
                    @endif
                @endforeach
                <x-seller-product-new>
                </x-seller-product-new>
            </div>
        </div>
    </div>
@endsection
