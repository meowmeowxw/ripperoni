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
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * Return JSON of a product name search
     * @param id of the product
     *
     * @return  View
     */
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('name', 'like', '%' . $request->name . '%')
                ->take(5)
                ->get();

            $output = '';
            if (count($products)) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($products as $product) {
                    $output .= '<li class="list-group-item"><a href="'.route('product.id', $product->id).'">'.$product->name.'</a></li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
            return $output;
        }
    }

}
