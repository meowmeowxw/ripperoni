@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/btn-product.js') }}" defer></script>
@endsection

@section('content')
    {{--
    <li>{{$product->name}}</li>
    <li>{{$seller->company}}</li>
    <li>{{$category->name}}</li>
    --}}
    <div class="container pt-3">
        <div class="row justify-content-center">

            <div class="col-12 col-md-5 w-auto h-auto">
                <a>
                    <img src="{{$product->path}}" class="w-75 m-1" alt=""/>
                </a>
            </div>

            <div class="col-md-7">
                <div class="col-12">
                    <div>
                        <p class="h3">
                            <a class="text-dark" href="#">{{$seller->company}}</a>
                        </p>
                    </div>
                    <div class="">
                        <p class="h1">
                            <strong>
                                {{$product->name}}
                            </strong>
                        </p>

                    </div>
                    <div>
                        <a class="bg-dark rounded-pill p-1">  {{ $category->name }}  </a>
                    </div>
                    <div class="mt-2">
                        <p class="h3">
                            <strong>
                                {{__('Description')}}:
                            </strong>
                        </p>
                        <p class="h3">{{$product->description}}</p>
                    </div>
                </div>

                <div class="col-8 align-content-center">
                    <div class="card bg-transparent text-center">
                        <div class="card-body">
                            {{--da fare if seller e if not seller per edit--}}

                            @guest
                                <p class="small">Login needed to buy</p>
                            @else
                                @if (Auth::user()->is_seller)
                                    <x-form.row-edit-product :product=$product ></x-form.row-edit-product>
                                @else
                                    <x-form.add-to-cart :product=$product></x-form.add-to-cart>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--
            <div class="col-12 d-sm-none text-center">
                <p class="h1">
                    <strong>
                        {{$product->name}}
                    </strong>
                </p>
                <p class="text-light small m-0">{{__('sell by')}} {{$seller->company}}</p>
                <p class=" bg-light rounded-pill">  {{ $category->name }}  </p>
            </div>
--}}
