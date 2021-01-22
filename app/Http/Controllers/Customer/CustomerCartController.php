<?php

namespace App\Http\Controllers\Customer;

use App\Mail\NewCustomerOrder;
use App\Mail\NewSellerOrder;
use App\Mail\NewUser;
use App\Providers\RouteServiceProvider;
use App\Models\Product;
use App\Models\Order;
use App\Models\Status;
use App\Models\User;
use App\Models\SellerOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class CustomerCartController extends Controller
{

    private function errorQuantity($id = null)
    {
        return back()->withErrors([
            'quantity' . $id => 'The selected quantity is not available',
        ]);
    }

    private function updateQuantity(Request $request, $add = true)
    {
        $request->validate([
            'id' => 'required|numeric|integer',
            'quantity' => 'required|numeric|integer|min:1',
        ]);

        $product = Product::find($request->id);
        $session = $request->session();

        $product_id = $request->input('id');
        $ordered_quantity = $request->input('quantity');

        if ($ordered_quantity > $product->quantity) {
            return $add ? $this->errorQuantity() : $this->errorQuantity($product_id);
        }

        if ($session->has('productsOrder')) {
            $productsOrder = $session->get('productsOrder');
            foreach ($productsOrder as $i => $po) {
                if ($po["product_id"] === $product_id) {
                    if ($po["ordered_quantity"] + $ordered_quantity > $product->quantity) {
                        return $add ? $this->errorQuantity() : $this->errorQuantity($po["ordered_quantity"]);
                    } else {
                        $session->forget('productsOrder');
                        if ($add) {
                            $productsOrder[$i]["ordered_quantity"] += $ordered_quantity;
                        } else {
                            $productsOrder[$i]["ordered_quantity"] = $ordered_quantity;
                        }
                        $session->put('productsOrder', $productsOrder);
                        return true;
                    }
                }
            }
        }

        return false;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $productsOrder = $request->session()->get('productsOrder');

        if (!$productsOrder) {
            return view('customer.cart');
        }

        $final_order = [];
        $total_price = 0;
        foreach ($productsOrder as $po) {
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
            'customer' => Auth::user()->customer,
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
        if (!$this->updateQuantity($request)) {
            $session = $request->session();
            $session->push('productsOrder', [
                'product_id' => $request->id,
                'ordered_quantity' => $request->quantity,
            ]);
        }

        return redirect(route('product.id', $request->id));
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

        $productsOrder = $request->session()->get('productsOrder');
        if (!$productsOrder) {
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
        $sellers = collect([]);
        foreach ($productsOrder as $po) {
            $product = Product::find($po["product_id"]);
            $seller = $product->seller;
            if (!$sellers->has($seller->id)) {
                $sellerOrder = new SellerOrder;
                $sellerOrder->status_id = Status::where('name', 'waiting')->first()->id;
                $sellerOrder->seller_id = $seller->id;
                $sellerOrder->order_id = $order->id;
                $sellerOrder->profit = 0.0;
                $seller->orders()->save($sellerOrder);
                $sellerOrder->save();
                $sellers->put($seller->id, $sellerOrder);
            }
            $ordered_quantity = $po["ordered_quantity"];
            if ($product->quantity - $ordered_quantity < 0) {
                foreach ($sellers as $s) {
                    $s->delete();
                }
                $order->delete();
                return $this->errorQuantity($product->id);
            }
            $product->quantity -= $ordered_quantity;
            $product->save();
            $sellerOrder = $sellers[$seller->id];
            $profit = $product->price * $ordered_quantity;
            $sellerOrder->products()->attach([$products[$product->id] = [
                'ordered_quantity' => $ordered_quantity,
                'total_price' => $profit,
                'single_price' => $product->price,
                'product_id' => $product->id,
            ]]);
            $sellerOrder->profit += $profit;
            $sellerOrder->save();
            $order->price += $profit;
        }

        $order->save();
        /*
        $order->products()->attach($products);

        $order->price = 0.0;
        foreach ($order->products as $product) {
            $order->price += $product->pivot->total_price;
        }
        $order->save();
        */

        Mail::to(Auth::user()->email)->send(new NewCustomerOrder(Auth::user(), $order));
        foreach ($order->sellerOrders as $sellerOrder) {
            $email = User::find($sellerOrder->seller->user->id)->email;
            Mail::to($email)->send(new NewSellerOrder($sellerOrder));
        }
        $request->session()->forget('productsOrder');

        return redirect(RouteServiceProvider::HOME);
    }

    public function update(Request $request)
    {
        // ($request, add: false) php 8
        if ($this->updateQuantity($request, false)) {
            return back();
        }
    }

    public function deleteProduct(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|integer',
        ]);

        $session = $request->session();
        if ($session->has('productsOrder')) {
            $index = -1;
            $productsOrder = $session->get('productsOrder');
            foreach ($productsOrder as $i => $po) {
                if ($po["product_id"] === $request->id) {
                    $index = $i;
                    break;
                }
            }
            if ($index !== -1) {
                $session->forget('productsOrder');
                array_splice($productsOrder, $index, 1);
                if (!empty($productsOrder)) {
                    $session->put('productsOrder', $productsOrder);
                }
            }
        }
        return back();
    }
}
