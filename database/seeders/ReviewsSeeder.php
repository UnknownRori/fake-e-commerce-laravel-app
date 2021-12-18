<?php

namespace Database\Seeders;

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
            'comment' => "This is comment"
        ]);
    }
}
