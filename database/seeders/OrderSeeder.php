<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Order;
use App\Models\SubOrder;

class OrderSeeder extends Seeder
{
    private const NUM_ORDER = 60;

    /**
     * Seed the categories table
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach (range(1, self::NUM_ORDER) as $i) {
            $created_at = $faker->dateTimeThisYear();
            $order = new Order([
                'credit_card' => Str::random(16),
                'price' => rand(3, 10),
                'created_at' => $created_at,
            ]);
            $customer = User::all()
                ->where('is_seller', false)
                ->random()
                ->customer;
            $customer->orders()->save($order);
        }
    }
}
