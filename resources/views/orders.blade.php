@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>User id: {{ $user->id }}</h1>
                    <h2>Orders:</h2>
                    @foreach ($orders as $order)
                        <section>
                            <h3>Order id: {{ $order->id }} with price: {{ $order->price }}</h3>
                            <subsection>
                                <h4>Beers</h4>
                                @foreach ($order->products()->get() as $beer)
                                    <li>{{ $beer->name }} quantity: {{ $beer->quantity }}</li>
                                @endforeach
                            </subsection>
                        </section>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
