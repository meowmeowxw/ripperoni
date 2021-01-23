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
        <div class="col align-content-center">
            <div id="name" class="my-3 page-header">
                <p class="h1 text-break text-center">
                    <strong>
                        {{$product->name}}
                    </strong>
                </p>
            </div>
            <div class="my-3 text-center">
                <p class="h3 border-bottom">
                    <a class="text-dark" href="{{route('seller.id', $seller->id)}}"> {{__('Company:')}} {{$seller->company}}</a>
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-5 w-auto h-auto">
                    <a>
                        <img src="{{$product->path}}" class="w-75 m-1" alt=""/>
                    </a>
                </div>

                <div class="col-12 col-md-7">
                    <div class="col-12">

                        <div class="my-3">
                            <a class="btn-lg btn-dark"
                               href="{{route('category.id', ['id' => $category->id])}}">  {{ $category->name }}  </a>
                        </div>

                    </div>

                    <div class="col-12 my-3">
                        <div class="card bg-transparent border-0 text-center">
                            <div class="card-body">
                                {{--da fare if seller e if not seller per edit--}}

                                @guest
                                    <p class="small">Login needed to buy</p>
                                @else
                                    @if (Auth::user()->is_seller)
                                        <x-form.row-edit-product :product=$product></x-form.row-edit-product>
                                    @else
                                        <x-form.add-to-cart :product=$product></x-form.add-to-cart>
                                    @endif
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3 jumbotron p-4">
                <h3 class="border-bottom text-center">
                    <strong>
                        {{__('Description')}}:
                    </strong>
                </h3>
                <p class="lead text-break">{{$product->description}}</p>
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
