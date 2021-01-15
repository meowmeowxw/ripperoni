<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{

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
        $products = Product::where('category_id', $id)->get();

        return view('category', [
            'products' => $products,
            'category' => $category
        ]);
    }
}
