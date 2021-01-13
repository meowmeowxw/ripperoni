<div class="card bg-transparent col border-0 {{$class ?? ''}}">

    <a href="{{route('product.id', ['id' => $product->id])}}">
        <img class="card-img-top" src="{{$product->path ?? '-'}}" alt="Card Beer {{$product->id+1 ?? '0'}}">
    </a>
    <div class="card-footer mt-auto">
        <div class="card-title">
            <strong>{{$product->name ?? '-'}}</strong>
        </div>
        <p class="card-text">sell by
            <strong>{{ \App\Models\Seller::where('id', $product->seller_id)->first()->company }}</strong>
        </p>
        {{--<b>{{ \App\Models\Seller::find($beer->seller_id)->company }}</b>--}}
    </div>
</div>

