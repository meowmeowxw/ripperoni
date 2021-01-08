<div class="card m-1" id="customer-order.{{$order->id}}">
    <div class="card-header d-flex flex-row">
        <div class="mr-auto">Order Id: <b>{{$order->id}}</b></div>
        <div class="ml-auto">Total Price: <b>{{$order->price}}€</b></div>
    </div>
    <div class="card-body">

        {{--
        <h4 class="card-title"> Price:{{$order->price}}€ </h4>
        --}}
        <div class="card-text">
            @foreach ($order->products as $beer)
                <div class="d-flex flex-row">
                    <div class="align-self-center">
                        <x-public.product :product=$beer :sellBy="TRUE"></x-public.product>
                    </div>
                    <div>
                        <img src="{{$beer->path}}" class="card-img-top" alt="{{$beer->name}}"/>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
