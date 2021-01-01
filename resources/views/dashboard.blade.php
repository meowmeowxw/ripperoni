@extends('layouts.app')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @foreach($categories as $category=>$products)
                    <section>
                        <h2> {{ $category }} </h2>
                        @foreach($products as $product)
                            <li>
                                <b>{{ $product->name }}</b>: {{ $product->description }}
                            </li>
                        @endforeach
                    </section>
                @endforeach
                You're logged in!
            </div>
        </div>
    </div>
</div>
@endsection
