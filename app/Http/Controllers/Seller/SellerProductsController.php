<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Models\Category;
use App\Models\Product;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Display the registration seller view.
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
            // 'path' => 'required|string|max:1024',
        ]);

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
        dd($request->file('logo'));
        $category = Category::where('name', $request->category)->first();
        dd($category->products);
        $request->validate([
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:1024',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|integer',
            'path' => 'required|image',
            'category' => 'required|string',
        ]);

        $category->products()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'seller_id' => Auth::user()->seller->id,
            'path' => $request->file('logo')->store(),
        ]);
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
