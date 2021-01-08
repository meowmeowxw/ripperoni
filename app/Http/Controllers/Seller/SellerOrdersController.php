<?php


namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Order;
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
        $orders = [];
        $total_profit = 0;
        /*
          Let's not use raw sql...
        $products = DB::table('products')
                    ->join('sub_orders', 'products.id', '=', 'sub_orders.product_id')
                    ->select('*')
                    ->where('seller_id', $seller->id)
                    ->get();
        dd($products);
        */

        foreach (Order::all() as $order) {
            $products = $order->products()->where('seller_id', $seller->id)->get();
            if ($products->count() !== 0) {
                $profit = 0;
                foreach ($products as $product) {
                    $profit += $product->pivot->total_price;
                }
                $total_profit += $profit;
                $orders[] = ['id' => $order->id, 'products' => $products, 'earning' => $profit];
            }
        }
        return view('seller.orders', [
            'seller' => $seller,
            'orders' => $orders,
            'total_profit' => $total_profit,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * TODO
     */
    public function store(Request $request)
    {
        Auth::user()->is_seller = true;
        Auth::user()->save();
        Auth::user()->seller()->create([
            'company' => $request->company,
            'credit_card' => $request->credit_card,
        ]);
        return redirect(RouteServiceProvider::HOME);
    }
}
