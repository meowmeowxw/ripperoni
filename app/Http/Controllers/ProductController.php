<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

    public function show()
    {
        $array = [];
        foreach (Category::all() as $category) {
            $products = Product::where('category_id', $category->id)->get();
            $array += [$category->name => $products];
            // dd($array);
        }
        return view('dashboard', ['categories' => $array]);
    }
}
