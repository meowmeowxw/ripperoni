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
                <div class="row">
                    <div class="col">
                        <p>{{__('From')}}: <a
                                href="{{route('seller.id', $sellerOrder->seller->id)}}">{{$sellerOrder->seller->company}}</a>
                        </p>
                    </div>
                    <div class="col">
                        <x-status :status="$sellerOrder->status->name"></x-status>
                    </div>
                </div>

                <div class="container-fluid border">
                @foreach($sellerOrder->products as $beer)
                    <div class="row mt-2">
                        <div class="col-4">
                            <a href="{{route('product.id', $beer->id)}}"><img src="{{$beer->path}}"
                                                                              class="card-img-top"
                                                                              alt="{{$beer->name}}"/></a>
                        </div>
                        <div class="col align-self-center">
                            <x-product :product=$beer></x-product>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="row mt-4">
                </div>
            @endforeach
        </div>
    </div>
</div>
