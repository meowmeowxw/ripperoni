<p class="m-0">

{{--
ordered_quantity
total_price
single_price
--}}
    <div class="row">
        <div class="col">
            <strong>{{ $product->name }}</strong>
        </div>
        <div class="col">
            {{ $product->pivot->ordered_quantity }} x {{ $product->pivot->single_price }} &euro; = {{ $product->pivot->total_price }}
        </div>
    </div>
    <div class="row">
        <div class="col">
            @isset($sellBy)
                @if($sellBy)
                    sell by {{ \App\Models\Seller::find($product->seller_id)->company }}
                @endif
            @endisset
        </div>
    </div>
</p>
