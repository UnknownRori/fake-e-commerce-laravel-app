<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'id' => 1,
            'users_id' => 2,
            'product_id' => 1,
            'star' => 3,
            'comment' => "This is comment",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('reviews')->insert([
            'id' => 2,
            'users_id' => 3,
            'product_id' => 1,
            'star' => 2,
            'comment' => "This is comment 2",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('reviews')->insert([
            'id' => 3,
            'users_id' => 4,
            'product_id' => 1,
            'star' => 2,
            'comment' => "This is comment 3",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('reviews')->insert([
            'id' => 4,
            'users_id' => 5,
            'product_id' => 1,
            'star' => 1,
            'comment' => "This is comment 4",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('reviews')->insert([
            'id' => 5,
            'users_id' => 6,
            'product_id' => 1,
            'star' => 5,
            'comment' => "This is comment 5",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
