<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@adminmail.com',
            'password' => Hash::make('admin'),
            'admin' => 1,
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'username' => 'users',
            'email' => 'users@usersmail.com',
            'password' => Hash::make('users'),
            'admin' => 0,
        ]);
    }
}
