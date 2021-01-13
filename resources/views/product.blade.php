@extends('layouts.app')

@section('content')
    {{--
    <li>{{$product->name}}</li>
    <li>{{$seller->company}}</li>
    <li>{{$category->name}}</li>
    --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 d-sm-none text-center">
                <p class="h1">
                    <strong>
                        {{$product->name}}
                    </strong>
                </p>
                <p class="text-light small m-0">{{__('sell by')}} {{$seller->company}}</p>
                <p class=" bg-light rounded-pill">  {{ $category->name }}  </p>
            </div>

            <div class="col-5 col-md-3 w-auto h-auto">
                <img src="{{$product->path}}" class="w-100 m-1" alt=""/>
            </div>

            <div class="col-7 col-md-6 p-1">
                <div class="container p-0 d-none d-sm-inline-block">
                    <p class="h1 float-left">{{$product->name}}</p>
                    <p class="float-right bg-light rounded-pill m-1 p-1">  {{ $category->name }}  </p>
                </div>
                <p class="d-none d-sm-block">{{__('sell by')}} {{$seller->company}}</p>
                <p class="">{{$product->description}}</p>
            </div>

            <div class="col-10 col-md-3">
                <div class="card card-body bg-transparent text-center">

                    <x-form.form id="add_to_cart"
                                 action="{{route('customer.cart')}}"
                                 enctype=""
                                 btntext="{{__('Add to cart')}}" btnaddclass="btn-lg btn-block"
                                 inputid="id" inputvalue="{{$product->id}}">

                        <x-FormInput name="quantity" idAndFor="quantityNew" inputValue="0" min="1"
                                     :lblName="__('Quantity')" type="number"/>
                    </x-form.form>
                </div>
            </div>
        </div>
    </div>
@endsection
