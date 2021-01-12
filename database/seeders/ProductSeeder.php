<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Seller;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Seed the categories table
     *
     * @return void
     */
    public function run()
    {
        $beers = [
            'Weiss' => [
                [
                    'name' => 'Weihenstephan',
                    'description' => 'A cloudy, Bavarian-style wheat brew, tops the list of beers to try. A light, yeasty sweetness (which some liken to bananas or bubblegum) makes it an extremely refreshing beer to drink before a meal or with a light dinner.',
                    'price' => 3.10,
                    'quantity' => 30,
                    'seller_id' => Seller::all()->random()->first()->id,
                    'path' => '/img/weihenstephan.png',
                ],
                [
                    'name' => 'Erdinger',
                    'description' => 'Gently spicy wheat and yeast aromas blend with mildly bitter hops. The invigorating carbon dioxide ensures its typical liveliness. A premium beer whose full-bodied yet elegant character leaves a lasting impression of ultimate Bavarian enjoyment',
                    'price' => 1.3,
                    'quantity' => 100,
                    'seller_id' => Seller::all()->random()->first()->id,
                    'path' => '/img/erdinger.png',
                ]
            ],
            'Ale' => [
                [
                    'name' => 'Ritual Pale Ale',
                    'description' => 'Spicy floral hops (chrysanthemum) hit strong, then medium rich malt, then a solid wall of bitterness to wrap it up. Light bread character in the background',
                    'price' => 2.30,
                    'quantity' => 2,
                    'seller_id' => Seller::all()->random()->first()->id,
                    'path' => '/img/ritual-pale-ale.png',
                ],
                [
                    'name' => 'Ghostfish Vanishing Point',
                    'description' => 'Banana candy (although not very sweet). Slight cidery/grape note. Some butterscotch malt sweetness. Mild grapefruit hops. Assertive bitterness is out of balance—hops are bitter but not flavorful.',
                    'price' => 3.33,
                    'quantity' => 4,
                    'seller_id' => Seller::where('company', 'A Company')->first()->id,
                    'path' => '/img/ghostfish-vanishing-point.png',
                ]
            ],
            'Pilsner' => [
                [
                    'name' => 'Live Oak Pilz',
                    'description' => 'A classic from the oldest brewery in Austin. Great malt character from single-decoction mashing and beautiful hoppiness from Saaz hops.',
                    'price' => 1,
                    'quantity' => 10,
                    'seller_id' => Seller::all()->random(1)->first()->id,
                    'path' => '/img/live-oak-pilz.jpg',
                ],
                [
                    'name' => 'Threes Vliet',
                    'description' => 'One of the cleanest, most drinkable American pilsners, it has classic cracker-like malt flavor and a truly balanced and subtle hop profile, which I feel a lot of breweries putting out great IPAs struggle to achieve with their pilsners.',
                    'price' => 3,
                    'quantity' => 5,
                    'seller_id' => Seller::all()->random(1)->first()->id,
                    'path' => '/img/threes-vliet.jpg',
                ]
            ],
            'Lager' => [
                [
                    'name' => 'Paulaner Munchner Hell',
                    'description' => 'Munich beer',
                    'price' => 1.10,
                    'quantity' => 4,
                    'seller_id' => Seller::where('company', 'A Company')->first()->id,
                    'path' => '/img/paulaner-munchner-hell.png',
                ],
                [
                    'name' => 'Moretti',
                    'description' => 'Italian beer',
                    'price' => 1.04,
                    'quantity' => 20,
                    'seller_id' => Seller::where('company', 'A Company')->first()->id,
                    'path' => '/img/moretti.png',
                ],
                [
                    'name' => 'Peroni',
                    'description' => 'Italian beer from 1846',
                    'price' => 1.30,
                    'quantity' => 30,
                    'seller_id' => Seller::all()->random()->first()->id,
                    'path' => '/img/peroni.jpg',
                ],
                [
                    'name' => 'Augustiner Hell',
                    'description' => 'Old Munich beer',
                    'price' => 2,
                    'quantity' => 30,
                    'seller_id' => Seller::all()->random()->first()->id,
                    'path' => '/img/augustiner.png',
                ]
            ],
        ];
        foreach ($beers as $categoryName => $products) {
            $category = Category::where('name', $categoryName)->first();
            $category->products()->createMany($products);
        }

        foreach(Product::all() as $product) {
            $seller = Seller::find($product->seller_id);
            $seller->products()->save($product);
        }
    }
}
