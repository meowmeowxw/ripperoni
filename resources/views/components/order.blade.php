<div class="card m-1" id="customer-order.{{$order->id}}">
    <div class="card-header d-flex flex-row">
        <div class="mr-auto">Order Id: <strong>{{$order->id}}</strong></div>
        <div class="ml-auto">Total Price: <strong>{{$order->price}} &euro;</strong></div>
    </div>
    <div class="card-body">

        {{--
        <h4 class="card-title"> Price:{{$order->price}}€ </h4>
        --}}
        <div class="card-text">
            @foreach ($order->sellerOrders as $sellerOrder)
                @foreach($sellerOrder->products as $beer)
                    <div class="row mt-4">
                        <div class="col-sm-3">
                            <a href="{{route('product.id', $beer->id)}}"><img src="{{$beer->path}}" class="card-img-top"
                                                                              alt="{{$beer->name}}"/></a>
                        </div>
                        <div class="col align-self-center">
                            <x-product :product=$beer></x-product>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
