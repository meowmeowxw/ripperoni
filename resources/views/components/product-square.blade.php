<div class="col-sm-6 col-md-4 services-box hoverServices p-1">
    <a href="{{route('product.id', ['id' => $product->id])}}" class="text-dark">
        <p class="h4 text-center">{{ $product->name }}</p>

        <div class="service-icon">
            <img src="{{$product->path ?? '-'}}"
                 alt="Card Beer {{$product->id+1 ?? '0'}}">
        </div>
    </a>
    <div class="row">
        <div class="col-4">
            <p class="font-weight-bold text-center">
                {{ $product->cl }} cl
            </p>
        </div>
        <div class="col-4">
            <p class="font-weight-bold text-center">
                {{ $product->alcohol }} % {{__('alcohol')}}
            </p>
        </div>
        <div class="col-4">
            <p class="font-weight-bold text-center">
                {{ $product->price }} &euro;
            </p>
        </div>
    </div>

</div>
