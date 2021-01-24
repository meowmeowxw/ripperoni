<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Category;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Return the view of a product
     * @param id of the product
     *
     * @return  View
     */
    public function view($id = 1)
    {
        $product = Product::find($id);
        $seller = Seller::find($product->seller_id);
        $category = Category::find($product->category_id);
        return view('product', [
            'product' => $product,
            'seller' => $seller,
            'category' => $category,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     *
     */
    public function show()
    {
        $products = Product::where('active', true)->paginate(Config::get('constants.numProducts'));
        $latest = Product::orderBy('created_at', 'DESC')->where('active', true)->take(3)->get();
        return view('dashboard', [
            'latest' => $latest,
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }
}
