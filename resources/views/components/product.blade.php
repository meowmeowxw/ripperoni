<div class="row">
    <div class="col">
        <a href="{{route('product.id', $product->id)}}"><strong>{{ $product->name }}</strong></a>
    </div>
    <div class="col">
        {{ $product->pivot->ordered_quantity }} x {{ $product->pivot->single_price }} &euro; =
        {{ $product->pivot->total_price }} &euro;
    </div>
</div>
