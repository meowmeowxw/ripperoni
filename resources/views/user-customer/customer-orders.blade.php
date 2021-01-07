
        <h3>Order id: {{ $attributes->get(order)->id }} with price: {{ $attributes->get('order')->price }}</h3>
        <subsection>
            <h4>Beers</h4>
            @foreach ($order->products as $beer)
                <li>{{ $beer->name }} quantity: {{ $beer->pivot->quantity }}</li>
            @endforeach
        </subsection>
