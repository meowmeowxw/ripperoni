<?php

namespace App\Http\Controllers\Customer;

use App\Providers\RouteServiceProvider;
use App\Models\Product;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CustomerCartController extends Controller
{

    private function errorQuantity()
    {
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
        $products_order = $request->session()->get('products_order');

        if (!$products_order) {
            return back();
        }

        $final_order = [];
        $total_price = 0;
        foreach ($products_order as $po) {
            $product_id = $po["product_id"];
            $ordered_quantity = $po["ordered_quantity"];
            $product = Product::find($po["product_id"]);
            $final_order[] = [
                'product_id' => $product_id,
                'ordered_quantity' => $ordered_quantity,
                'total_price' => $ordered_quantity * $product->price,
                'single_price' => $product->price,
                'product' => $product,
            ];
            $total_price += $ordered_quantity * $product->price;
        }
        return view('customer.cart', [
            'final_order' => $final_order,
            'total_price' => $total_price,
        ]);
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
            'quantity' => 'required|numeric|integer|min:1',
        ]);

        $customer = Auth::user()->customer;
        $product = Product::find($request->id);
        $session = $request->session();

        if (!$product) {
            return back();
        }

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

        if (!$push_data) {
            $session->push('products_order', [
                'product_id' => $product_id,
                'ordered_quantity' => $ordered_quantity,
            ]);
        }

        return redirect(route('product.id', $request->id));
    }

    /**
     * Display a view with the customer detail to buy the order
     *
     * @param Request $request
     */
    public function customerDetails(Request $request)
    {
        if ($request->session()->has('products_order')) {
            $customer = Auth::user()->customer;
            return view('customer.details', ['customer' => $customer]);
        } else {
            return back();
        }
    }

    /**
     * Buy products
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function buy(Request $request)
    {
        $request->validate([
            'credit_card' => 'required|string|digits_between:10,24',
            'street' => 'required|string|max:128',
            'city' => 'required|string|max:128',
        ]);

        $products_order = $request->session()->get('products_order');
        if (!$products_order) {
            return back();
        }

        $customer = Auth::user()->customer;
        $order = new Order([
            'credit_card' => $request->credit_card,
            'street' => $request->street,
            'city' => $request->city,
            'price' => 0.0,
        ]);
        $customer->orders()->save($order);

        $products = [];
        foreach ($products_order as $po) {
            $product = Product::find($po["product_id"]);
            $products[$product->id] = [
                'ordered_quantity' => $po["ordered_quantity"],
                'total_price' => $product->price * $po["ordered_quantity"],
                'single_price' => $product->price,
                'product_id' => $product->id,
            ];
            $product->quantity -= $po["ordered_quantity"];
            $product->save();
        }
        $order->products()->attach($products);

        $order->price = 0.0;
        foreach ($order->products as $product) {
            $order->price += $product->pivot->total_price;
        }
        $order->save();

        $request->session()->forget('products_order');

        return redirect(RouteServiceProvider::HOME);
    }
}
