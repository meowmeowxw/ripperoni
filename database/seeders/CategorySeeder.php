<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Seed the categories table
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Ale',
            'Pilsner',
            'Lager',
        ];
        foreach($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}
