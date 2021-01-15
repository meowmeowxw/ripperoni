@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3" id="customer-order.{{$sellerOrder->order}}">
                    <div class="card-header d-flex flex-row">
                        <div class="mr-auto">Order Id: <strong>{{$sellerOrder->id}}</strong></div>
                        <div class="ml-auto">Total Price: <strong>{{$sellerOrder->profit}} &euro;</strong></div>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            @foreach ($sellerOrder->products as $beer)
                                <div class="row mt-4">
                                    <div class="col-sm-3">
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
                    </div>
                    <div class="card-footer text-muted text-center">
                        <h5>{{__('Current status')}}:
                            <span class="badge badge-pill badge-primary"> {{$currentStatus->name}} </span>
                        </h5>
                        <x-form.form action="{{route('seller.order.update')}}" enctype="multipart/form-data"
                                     btntext="{{ __('Save') }}" btnaddclass="btn-lg btn-block" inputid="status"
                                     inputvalue="{{$sellerOrder->id}}">

                            <x-form.form-div>
                                <label for="status" class="mb-0">{{ __('Order status') }}</label>
                                {{-- Set autocomplete="off" to make select value as default --}}
                                <select autocomplete="off" class="form-control mb-2" id="status" name="status">
                                    <option selected>{{$currentStatus->name}}</option>
                                    @foreach ($allStatus as $status)
                                        @if ($status->name !== $currentStatus->name)
                                            <option>{{$status->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </x-form.form-div>
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection