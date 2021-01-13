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
            @foreach ($order->products as $beer)
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{$beer->path}}" class="card-img-top" alt="{{$beer->name}}"/>
                    </div>
                    <div class="col align-self-center">
                        <x-public.product :product=$beer :sellBy="TRUE"></x-public.product>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
