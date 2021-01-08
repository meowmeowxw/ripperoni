<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Models\Category;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SellerProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'auth',
            'seller'
        ]);
    }

    /**
     * Delete a product (Set quantity to 0 and is_available to false)
     *
     * @return \Illuminate\View\View
     */
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|integer',
        ]);

        if (! Gate::allows('edit-product', Product::find($request->id))) {
            abort(403);
        }

        $product = Auth::user()->seller->products()->find($request->id);
        $product->is_available = false;
        $product->quantity = 0;
        $product->save();
        return redirect(route('seller.products'));
    }
    /**
     * Edit a product
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:1024',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|integer',
            'id' => 'required|numeric|integer',
            // 'path' => 'required|string|max:1024',
        ]);

        if (! Gate::allows('edit-product', Product::find($request->id))) {
            abort(403);
        }

        $product = Auth::user()->seller->products()->find($request->id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        // $product->path = $request->path;
        $product->save();
        return redirect(route('seller.products'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:1024',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|integer',
            'logo' => 'mimes:jpg,bmp,png|required',
            'category' => 'required|string',
        ]);

        $category = Category::where('name', $request->category)->first();
        $product = new Product([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'path' => "/".$request->file('logo')->store('logos'),
        ]);
        $product->category_id = $category->id;
        $product->seller_id = Auth::user()->seller->id;
        $product->save();
        return redirect(route('seller.products'));
    }

    /**
     * Display the registration seller view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $seller = Seller::where('user_id', Auth::user()->id)->first();
        $categories = Category::all();
        $products = $seller->products()->get();
        return view('seller.products', [
            'seller' => $seller,
            'products' => $products,
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
