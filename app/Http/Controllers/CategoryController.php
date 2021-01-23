<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class CategoryController extends Controller
{

    private const NUM_ITEMS = 15;

    /**
     * Return the view of a product
     * @param int id of the product
     *
     * @param
     * @return View
     */
    public function view($id = 1): View
    {
        $category = Category::find($id);
        $products = $category->products()->where('is_available', true)->paginate(Config::get('constants.numProducts.'));

        return view('category', [
            'products' => $products,
            'category' => $category
        ]);
    }
}
