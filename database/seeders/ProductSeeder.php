<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'id' => 1,
            'users_id' => 1,
            'productname' => 'TestProduct1',
            'price' => 40,
            'stock' => 5
        ]);
        DB::table('product')->insert([
            'id' => 2,
            'users_id' => 1,
            'productname' => 'TestProduct2',
            'price' => 10,
            'stock' => 400
        ]);
        DB::table('product')->insert([
            'id' => 3,
            'users_id' => 1,
            'productname' => 'TestProduct3',
            'price' => 100,
            'stock' => 1
        ]);
        DB::table('product')->insert([
            'id' => 4,
            'users_id' => 1,
            'productname' => 'TestProduct4',
            'price' => 20,
            'stock' => 50
        ]);
    }
}
