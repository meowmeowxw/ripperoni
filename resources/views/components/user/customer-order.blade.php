<div class="card m-1">
    <div class="card-body">
        <h4 class="card-title">Order Id:{{$order->id}} Paid:{{$order->price}}€</h4>
        <p class="card-text">
            @foreach ($order->products as $beer)
                {{ $beer->pivot->quantity }}x {{ $beer->name }} sell by {{ \App\Models\Seller::find($beer->seller_id)->company }} <br>
            @endforeach
        </p>
    </div>
</div>
