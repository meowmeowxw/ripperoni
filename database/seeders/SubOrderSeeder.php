<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Order;
use App\Models\SubOrder;
use App\Models\Product;

class SubOrderSeeder extends Seeder
{
    private const MAX_PRODUCTS = 5;
    private const MAX_QUANTITY = 3;
    /**
     * Seed the categories table
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (Order::all() as $order) {
            $created_at = $faker->dateTimeThisYear;
            $products = Product::all()->random()
                ->take($faker->numberBetween(1, self::MAX_PRODUCTS))
                ->get()
                ->mapWithKeys(function($product) use ($faker, $created_at) {
                    $quantity = $faker->numberBetween(1, self::MAX_QUANTITY);
                    return [
                        $product->id => [
                            'quantity' => $quantity,
                            'price' => $product->price * $quantity,
                            'created_at' => $created_at,
                            'updated_at' => $created_at,
                        ],
                    ];
                })
                ->all();
            $order->products()->attach($products);
            $order->price = 0.0;
            foreach ($order->products as $product) {
                $order->price += $product->pivot->price;
            }
            $order->save();
        }
    }
}
