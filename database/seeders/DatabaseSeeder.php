<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ReviewsSeeder::class);
        $this->call(SubscribeSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(PurchaseSeeder::class);
    }
}
