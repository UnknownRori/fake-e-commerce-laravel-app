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
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quibusdam corrupti eos quasi voluptate ea provident quae corporis laudantium, eaque quas nesciunt ratione possimus nulla magnam dignissimos! Natus, saepe doloremque?",
            'price' => 40,
            'stock' => 5,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 2,
            'users_id' => 1,
            'productname' => 'No Phone Selfie',
            'description' => "it's can do selfie thing",
            'price' => 10,
            'stock' => 400,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 3,
            'users_id' => 1,
            'productname' => 'No Phone',
            'description' => "Is this phone?",
            'price' => 100,
            'stock' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 4,
            'users_id' => 1,
            'productname' => 'No Phone Family Pack',
            'description' => "No phone for family",
            'price' => 20,
            'stock' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 5,
            'users_id' => 1,
            'productname' => 'No Phone Employee Pack',
            'description' => "No phone for your Employee",
            'price' => 20,
            'stock' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 6,
            'users_id' => 1,
            'productname' => 'nophone',
            'description' => "The No Phone",
            'price' => 20,
            'stock' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('product')->insert([
            'id' => 7,
            'users_id' => 1,
            'productname' => 'nophone2',
            'description' => "The No Phone",
            'price' => 20,
            'stock' => 50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
