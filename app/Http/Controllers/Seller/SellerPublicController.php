<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class SellerPublicController extends Controller
{
    /**
     * Instantiate a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display the seller public view.
     *
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $seller = Seller::find($id);
        $products = $seller->products()->paginate(Config::get('constants.numProducts', 15));
        return view('seller.public', [
            'seller' => $seller,
            'products' => $products,
        ]);
    }

}
