<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'productname' => 'No Phone Air',
            'price' => 40,
            'stock' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 2,
            'users_id' => 1,
            'productname' => 'No Phone Selfie',
            'price' => 10,
            'stock' => 400,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 3,
            'users_id' => 1,
            'productname' => 'No Phone',
            'price' => 100,
            'stock' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 4,
            'users_id' => 1,
            'productname' => 'No Phone Family Pack',
            'price' => 20,
            'stock' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 5,
            'users_id' => 1,
            'productname' => 'No Phone Employee Pack',
            'price' => 20,
            'stock' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 6,
            'users_id' => 1,
            'productname' => 'nophone',
            'price' => 20,
            'stock' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 7,
            'users_id' => 1,
            'productname' => 'nophone2',
            'price' => 20,
            'stock' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
