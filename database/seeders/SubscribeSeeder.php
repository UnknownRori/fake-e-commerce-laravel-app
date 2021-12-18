<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscribe')->insert([
            'id' => 1,
            'users_id' => 2,
            'email' => 'users@usersmail.com',
        ]);
    }
}
