@extends('layouts.app')

@section('content')
    <li>{{$product->name}}</li>
    <li>{{$seller->company}}</li>
    <li>{{$category->name}}</li>
    <div class="container">
        <div class="row">
            <div class="col">
                <img src="{{$product->path}}" class="m-1 img-fluid" alt=""/>
            </div>
            <div class="col-6">
                <div class="card">
                    <h3 class="card-title">{{$product->description}}</h3>
                </div>
            </div>
            <div class="col">
                <div class="card card-body bg-transparent text-center">

                    <x-form.form id="add_to_cart"
                                 action="{{route('customer.cart')}}"
                                 enctype=""
                                 btntext="{{__('Add to cart')}}" btnaddclass="btn-lg btn-block"
                                 inputid="id" inputvalue="{{$product->id}}" >

                        <x-FormInput name="quantity" idAndFor="quantityNew" inputValue="0" min="1" :lblName="__('Quantity')" type="number"/>
                    </x-form.form>
                </div>
            </div>
        </div>
    </div>
@endsection
