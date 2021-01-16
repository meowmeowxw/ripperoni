<div class="col-12 col-md-6 services-box hoverServices p-1">
    <a href="{{route('product.id', ['id' => $product->id])}}" class="text-dark">
        <p class="h4 text-center">{{ $product->name }}</p>

        <div class="service-icon">
            <img src="{{$product->path ?? '-'}}"
                 alt="Card Beer {{$product->id+1 ?? '0'}}">
        </div>
    </a>
    <p class="font-italic text-center">
        {{ $product->description }}
    </p>
</div>
