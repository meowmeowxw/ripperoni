<p class="m-0">

{{--
ordered_quantity
total_price
single_price
--}}
    <div class="row">
        <div class="col">
            <a href="{{route('product.id', $product->id)}}"><strong>{{ $product->name }}</strong></a>
        </div>
        <div class="col">
            {{ $product->pivot->ordered_quantity }} x {{ $product->pivot->single_price }} &euro; = {{ $product->pivot->total_price }}
        </div>
    </div>
    <div class="row">
        <div class="col">
            @isset($sellBy)
                @if($sellBy)
                    @php
                    $seller = \App\Models\Seller::find($product->seller_id);
                    @endphp
                    sell by <a href="{{route('seller.id', $seller->id)}}">{{ $seller->company }}</a>
                @endif
            @endisset
        </div>
    </div>
</p>
