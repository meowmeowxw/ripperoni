<p class="m-0">

    {{ $product->pivot->quantity }}x {{ $product->pivot->price }}€ <b>{{ $product->name }}</b>

    @isset($sellBy)
        @if($sellBy)
            sell by {{ \App\Models\Seller::find($product->seller_id)->company }} <br>
        @endif
    @endisset
</p>