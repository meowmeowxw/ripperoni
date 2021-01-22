@extends('layouts.app')

@section('styles')
    <style>
        input[type=number] {
            width: 80px;
            padding: 5px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        const proceed = ["{{__('Proceed')}}", "^"];
        let i = 0;
        window.addEventListener('load', function () {
            let selector = [];
            @php
                $selectors = [];
                foreach ($final_order as $fo) {
                    $product = $fo["product"];
                    $selectors[] = $product->id;
                }
            @endphp
            $("#proceed").click(function () {
                i = (i + 1) % 2;
                $(this)[0].innerText = proceed[i];
            });
            @foreach ($selectors as $selector)
            $("{{'#error'.$selector}}").hide();
            $("{{'#quantity'.$selector}}").on("change keyup", function () {
                let val = parseInt($(this)[0].value);
                if (val && val >= 1) {
                    $.ajax({
                        url: `${searchPath}customer/cart/update`,
                        type: "POST",
                        data: {"id": {{$selector}}, "quantity": val},
                        success: function (data) {
                            if (data !== '') {
                                console.log(data);
                                if (data.hasOwnProperty('new_price')) {
                                    $("{{'#quantity'.$selector}}").attr("class", "");
                                    $("{{'#error'.$selector}}").hide();
                                    $("{{'#total-price'.$selector}}")[0].innerText = data.new_price.toFixed(2);
                                    let tot = parseFloat($('#total-price')[0].innerText);
                                    tot -= data.old_price;
                                    tot += data.new_price;
                                    $('#total-price')[0].innerText = tot.toFixed(2);
                                } else {
                                    $("{{'#quantity'.$selector}}").attr("class", "form-control mb-2 is-invalid");
                                    $("{{'#error'.$selector}}").html("<strong>" + data.error + "</strong>");
                                    $("{{'#error'.$selector}}").show();
                                }
                            }
                        }
                    })
                }
            });
            @endforeach
        })
    </script>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($final_order)
                    <div class="card mt-3" id="customer-cart">
                        <div class="card-header">
                            {{__('Total price')}}: <label id="total-price">{{ $total_price }}</label>
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                @foreach ($final_order as $fo)
                                    @php
                                        $product = $fo["product"];
                                    @endphp
                                    <div class="row mt-3">
                                        <div class="col-3">
                                            <a href="{{route('product.id', $product->id)}}"><img
                                                    src="{{$product->path}}"
                                                    class="card-img-top"
                                                    alt="{{$product->name}}"/></a>
                                        </div>
                                        <div class="col col-5 align-self-center">
                                            <div class="row">
                                                <a href="{{route('product.id', $product->id)}}"><strong>{{ $product->name }}</strong></a>
                                            </div>
                                            <div class="row mt-2 align-items-center">
                                                <form id="{{'update'.$product->id}}"
                                                      action="{{route('customer.cart.update')}}" method="POST">
                                                    @csrf
                                                    <input id="{{'product'.$product->id}}" value="{{$product->id}}"
                                                           name="id"
                                                           type="hidden">
                                                    <input id="{{'quantity'.$product->id}}" type="number"
                                                           name="quantity"
                                                           class=""
                                                           value="{{$fo["ordered_quantity"]}}"/> x
                                                    <label id="{{'single-price'.$product->id}}">
                                                        {{ $fo["single_price"] }}
                                                    </label> &euro;
                                                    =
                                                    <label id="{{'total-price'.$product->id}}">
                                                        {{ $fo["total_price"] }}
                                                    </label>
                                                    &euro;
                                                    <div class="row">
                                                        <span id="{{'error'.$product->id}}" class="invalid-feedback"
                                                              role="alert">
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col col-4 align-self-center">
                                            <div class="row">
                                                <form id="{{'delete'.$product->id}}"
                                                      action="{{route('customer.cart.delete-product')}}"
                                                      method="POST">
                                                    @csrf
                                                    <input id="{{'product'.$product->id}}" value="{{$product->id}}"
                                                           name="id"
                                                           type="hidden">
                                                </form>
                                                <a href="#"
                                                   onclick="document.getElementById('{{"delete".$product->id}}').submit();">{{__('Delete')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row mt-4">
                                    <div class="col">
                                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse"
                                                data-target="#collapse" aria-expanded="false"
                                                id="proceed"
                                                aria-controls="collapseButton">
                                            {{__('Proceed')}}
                                        </button>
                                    </div>
                                </div>
                                <div class="collapse" id="collapse">
                                    <div class="row mt-4">
                                        <div class="col">
                                            <x-form.form action="{{route('customer.cart.buy')}}"
                                                         btntext="{{ __('Buy') }}"
                                                         btnaddclass="btn-block">
                                                <x-FormInput name="credit_card" idAndFor="credit_card"
                                                             :lblName="__('Credit Card')"
                                                             inputValue="{{Auth::user()->customer->credit_card}}"
                                                             type="text"/>
                                                <x-FormInput name="street" idAndFor="street"
                                                             :lblName="__('Street Address')"
                                                             inputValue="{{Auth::user()->customer->street}}"
                                                             type="text"/>
                                                <x-FormInput name="city" idAndFor="city" :lblName="__('City')"
                                                             inputValue="{{Auth::user()->customer->city}}" type="text"/>
                                            </x-form.form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @else
                {{__('The cart is empty')}}
            @endisset
        </div>
    </div>
    </div>
@endsection

