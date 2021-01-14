<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Seed the categories table
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            ['name' => 'delivered'],
            ['name' => 'shipped'],
            ['name' => 'confirmed'],
            ['name' => 'waiting'],
        ]);
    }
}
