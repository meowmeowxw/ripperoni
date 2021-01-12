<?php

namespace App\Http\Controllers\Customer;

use App\Providers\RouteServiceProvider;
use App\Models\Product;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerCartController extends Controller
{

    private function errorQuantity() {
        return back()->withErrors([
            'quantity' => 'The select quantity is not available',
        ]);
    }

    public function __construct()
    {
        $this->middleware([
            'auth',
            'customer'
        ]);
    }

    /**
     * Display the customer cart view
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $products_order = collect($request->session()->get('products_order'));
        return view('customer.cart', ['products_order' => $products_order]);
    }

    /**
     * Handle an incoming store in cart request
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|integer',
            'quantity' => 'required|numeric|integer',
        ]);

        $customer = Auth::user()->customer;
        $product = Product::find($request->id);
        $session = $request->session();

        $product_id = $request->input('id');
        $ordered_quantity = $request->input('quantity');
        $push_data = false;

        if ($ordered_quantity > $product->quantity) {
            return $this->errorQuantity();
        }

        if ($session->has('products_order')) {
            $products_order = $session->get('products_order');
            foreach ($products_order as $i => $po) {
                if ($po["product_id"] === $product_id) {
                    if ($po["ordered_quantity"] + $ordered_quantity > $product->quantity) {
                        return $this->errorQuantity();
                    } else {
                        $session->forget('products_order');
                        $products_order[$i]["ordered_quantity"] += $ordered_quantity;
                        $session->put('products_order', $products_order);
                        $push_data = true;
                        break;
                    }
                }
            }
        }

        if (! $push_data) {
            $session->push('products_order', [
                'product_id' => $product_id,
                'ordered_quantity' => $ordered_quantity,
            ]);
        }

        return redirect(route('product.id', $request->id));
    }
}
