<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        DB::table('users')->insert([
            'name' => "a",
            'email' => 'a@a.it',
            'password' => Hash::make('a'),
            'remember_token' => Str::random(10),
            'is_seller' => True,
        ]);
    }
}
