<?php


namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Order;
use App\Models\SellerOrder;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerOrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'auth',
            'seller'
        ]);
    }

    /**
     * Display the registration seller view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $seller = Auth::user()->seller;
        $seller_orders = SellerOrder::where('seller_id', $seller->id)->get();
        $total_profit = 0;
        foreach ($seller_orders as $seller_order) {
            $total_profit += $seller_order->profit;
        }

        return view('seller.orders', [
            'seller' => $seller,
            'seller_orders' => $seller_orders,
            'total_profit' => $total_profit,
        ]);
    }

}
