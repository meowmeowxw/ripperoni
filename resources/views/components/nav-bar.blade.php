<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <!-- TODO: or container-fluid ? -->
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Ripperoni') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- center Side Of Navbar -->
            <ul class="navbar-nav mx-auto">

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link container-fluid" href="#"
                       data-toggle="dropdown" aria-expanded="false" v-pre>
                        <form class="form-inline text-center" autocomplete="off">
                            <input class="form-control" type="search" id="search" name="search" placeholder="Search"
                                   aria-label="Search" >
                        </form>
                    </a>
                    <div id="product_list" class="dropdown-menu bg-transparent border-0 p-0" aria-labelledby="search-item">
                    </div>
                </li>
            </ul>

            <!-- TODO: implement search ? -->
            {{--
            <a data-toggle="dropdown" aria-expanded="false">
                <form class="navbar-nav form-inline my-2 my-lg-0 text-align:center" autocomplete="off">
                    <input class="form-control mr-sm-2" type="search" id="search" name="search" placeholder="Search"
                           aria-label="Search" data-bs>
                    <!-- <button class="btn btn-outline-success my-2 my-sm-0 bg-dark" type="submit">Search</button> -->
                </form>
            </a>
            <div class="nav-item dropdown">
                <div class="dropdown-menu">

                </div>
            </div>
            --}}

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('seller.register') }}">{{ __('Register Seller') }}</a>
                    </li>
                @else
                    @if (Auth::user()->is_seller)
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{Auth::user()->seller->company}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="seller">
                                <a class="dropdown-item" href="{{route('seller.settings')}}">{{__('Settings')}}</a>
                                <a class="dropdown-item" href="{{route('seller.products')}}">{{__('My products')}}</a>
                                <a class="dropdown-item" href="{{route('seller.orders')}}">{{__('Orders')}}</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('orders')}}">{{__('Orders')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('customer.settings')}}">{{__('Settings')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{route('customer.cart')}}">{{__('Cart')}}@if(Session::has('productsOrder'))
                                    :{{count(Session::get('productsOrder'))}} @endif</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

