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
            'username' => 'UnknownRori',
            'email' => 'UnknownRori@mail.com',
            'password' => Hash::make('UnknownRori'),
            'admin' => 1,
            'vendor' => 1,
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'username' => 'users',
            'email' => 'users@usersmail.com',
            'password' => Hash::make('users'),
            'admin' => 0,
            'vendor' => 0,
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'username' => 'vendor',
            'email' => 'vendor@usersmail.com',
            'password' => Hash::make('vendor'),
            'admin' => 0,
            'vendor' => 1,
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'username' => 'users1',
            'email' => 'users1@usersmail.com',
            'password' => Hash::make('users1'),
            'admin' => 0,
            'vendor' => 0,
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'username' => 'users2',
            'email' => 'users2@usersmail.com',
            'password' => Hash::make('vendor'),
            'admin' => 0,
            'vendor' => 0,
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'username' => 'users3',
            'email' => 'users3@usersmail.com',
            'password' => Hash::make('users3'),
            'admin' => 0,
            'vendor' => 0,
        ]);
    }
}
