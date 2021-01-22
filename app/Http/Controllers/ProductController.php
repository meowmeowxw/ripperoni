<?php


namespace App\Http\Controllers;

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

    private const NUM_ITEMS = 9;
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
    public function show(Request $request)
    {
        if ($request->ajax() && $request->category !== null) {
            $category = Category::where('name', $request->category)->first();
            if ($category) {
                $products = $category
                    ->products()
                    ->where('is_available', true)
                    ->paginate(self::NUM_ITEMS);


                $output = '<div class="row justify-content-center">';
                foreach ($products as $product)
                {
                    $output .= view('components.product-square', ['product' => $product]);
                }
                $output .= '</div>';
                return $output;
            } else {
                abort(404);
            }
        } else {
            $products = Product::where('is_available', true)->paginate(self::NUM_ITEMS);
        }

        $latest = Product::orderBy('created_at', 'DESC')->where('is_available', true)->take(3)->get();
        return view('dashboard', [
            'latest' => $latest,
            'products' => $products,
            'categories' => Category::all(),
            ]);
    }
}
