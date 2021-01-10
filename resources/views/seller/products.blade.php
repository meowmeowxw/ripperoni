@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($products as $product)
                    @if ($product->is_available)
                        <x-seller-product :path="$product->path"
                                          title="$product->name" id="$product->id"
                                          name="$product->name" description="$product->description"
                                          price="$product->price" quantity="$product->quantity" />
                        </x-seller-product>
                    @endif
                @endforeach
                <x-seller-product-new>
                </x-seller-product-new>
            </div>
        </div>
    </div>
@endsection
