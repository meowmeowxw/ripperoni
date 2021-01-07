<div class="card m-1">
    <div class="card-header">
        Order Id:{{$order->id}}
    </div>
    <div class="card-body">
        <h4 class="card-title">Price:{{$order->price}}€</h4>
        @foreach ($order->products as $beer)
            <p class="card-text m-0">

                {{ $beer->pivot->quantity }}x {{ $beer->pivot->price }}€ <b>{{ $beer->name }}</b> sell
                by {{ \App\Models\Seller::find($beer->seller_id)->company }} <br>

            </p>
        @endforeach
    </div>
</div>
