<nav class="navbar navbar-light navbar-expand-md bg-white shadow-sm justify-content-center">
    <a class="navbar-brand w-50 mr-auto" href="{{ url('/') }}">
        {{ config('app.name', 'Ripperoni') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="navbar-collapse collapse w-100" id="navbarSupportedContent">
        <!-- center Side Of Navbar -->
        <ul class="navbar-nav w-100 justify-content-center">

            <li class="nav-item dropdown ">
                <a id="navbarDropdown" class="nav-link" href="#"
                   data-toggle="dropdown" aria-expanded="false" v-pre>
                    <form class="form-inline text-center" autocomplete="off">
                        <input class="form-control" type="search" id="search" name="search" placeholder="Search"
                               aria-label="Search">
                    </form>
                </a>
                <div id="product_list" class="dropdown-menu bg-transparent border-0 p-0 w-100"
                     aria-labelledby="search-item">
                </div>
            </li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end align-items-center">
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
                        <div class="dropdown-menu dropdown-menu" aria-labelledby="seller">
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
</nav>

