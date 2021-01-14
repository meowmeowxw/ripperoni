<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use App\Models\SellerOrder;
use App\Models\Status;

class SellerOrderSeeder extends Seeder
{
    private const NUM_ORDERS = 60;

    /**
     * Seed the seller_orders table
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (range(1, self::NUM_ORDERS) as $i) {
            $seller = Seller::inRandomOrder()->first();
            $created_at = $faker->dateTimeThisYear();

            $seller_order = new SellerOrder([
                'profit' => 0.0,
                'status_id' => Status::inRandomOrder()->first()->id,
                'seller_id' => $seller->id,
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ]);
            $seller->orders()->save($seller_order);
        }
    }
}
