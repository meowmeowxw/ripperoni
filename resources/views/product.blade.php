@extends('layouts.app')
@section('scripts')
    <script src="{{ asset('js/btn-product.js') }}" defer></script>
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
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
                    <a class="text-dark"
                       href="{{route('seller.id', $seller->id)}}"> {{__('Company:')}} {{$seller->company}}</a>
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-5 align-self-center">
                    <div class="product-img">
                        <img src="{{$product->path}}" class="" alt="Beer {{$product->id ?? '0'}}"/>
                    </div>
                </div>

                <div class="col-12 col-md-7">
                    <div class="col-12">
                        <div class="row justify-content-center m-1">
                            <p class="h4 ">
                                {{$product->price}} €
                            </p>
                        </div>
                        <div class="row justify-content-center m-1">
                            <p class="h4">
                            @if($product->isAvailable())
                                ( {{$product->quantity}} {{__('in stock')}} )
                            @else
                                ({{__('Not in stocks')}} )
                            @endif
                            </p>
                        </div>

                        <div class="my-3 jumbotron p-4">
                            <h4 class="border-bottom text-center">
                                    {{__('Description')}}:
                            </h4>
                            <p class="text-break small">{{$product->description}}</p>
                        </div>
                    </div>

                    <div class="col-12 my-3">
                        <div class="card bg-transparent border-0 text-center">
                            <div class="card-body m-0 d-flex justify-content-center">
                                {{--da fare if seller e if not seller per edit--}}

                                @guest
                                    <p class="text-danger ">Login needed to buy</p>
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

            <div class="row justify-content-center mt-1">
                <div class="col-12 col-md-6">
                    <table id="details" class="table table-striped text-center">
                        <caption class="h4">{{__('Details')}}:</caption>
                        <tr>
                            <th>
                                {{__('Category')}}
                            </th>
                            <td>
                                <a href="{{route('category.id', $category->id)}}" class="text-info">
                                    {{$category->name}}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Format')}}
                            </th>
                            <td>
                                {{$product->cl}} cl
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{__('Alcohol')}}
                            </th>
                            <td>
                                {{$product->alcohol}} %
                            </td>
                        </tr>
                    </table>
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
