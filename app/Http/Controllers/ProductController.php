<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
     * TODO Remove this function
     */
    public function show()
    {
        $array = [];
        $categories = [];
        foreach (Category::all() as $category) {
            $products = Product::where('category_id', $category->id)->get();
            $array += [$category->id => $products];
            // dd($array);
            $categories += [$category->id => $category->name];
        }
        $latest = Product::orderBy('created_at', 'DESC')->where('is_available', true)->get();
        return view('dashboard', [
            'latest' => $latest,
            'all_product' => $array,
            'categories' => $categories,
            ]);
    }
}
