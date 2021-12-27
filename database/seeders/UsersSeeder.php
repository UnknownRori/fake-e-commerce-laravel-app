<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'credit_card' => Hash::make('12345'),
            'admin' => 1,
            'vendor' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'username' => 'users',
            'email' => 'users@usersmail.com',
            'password' => Hash::make('users'),
            'credit_card' => Hash::make('AB123'),
            'admin' => 0,
            'vendor' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'username' => 'vendor',
            'email' => 'vendor@usersmail.com',
            'password' => Hash::make('vendor'),
            'credit_card' => Hash::make('AC1234'),
            'admin' => 0,
            'vendor' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'username' => 'users1',
            'email' => 'users1@usersmail.com',
            'password' => Hash::make('users1'),
            'credit_card' => Hash::make('WQ1234'),
            'admin' => 0,
            'vendor' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'username' => 'users2',
            'email' => 'users2@usersmail.com',
            'password' => Hash::make('vendor'),
            'credit_card' => Hash::make('WW1234'),
            'admin' => 0,
            'vendor' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'username' => 'users3',
            'email' => 'users3@usersmail.com',
            'password' => Hash::make('users3'),
            'credit_card' => Hash::make('RR123'),
            'admin' => 0,
            'vendor' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => 7,
            'username' => 'users4',
            'email' => 'users4@usersmail.com',
            'password' => Hash::make('users4'),
            'admin' => 0,
            'vendor' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => 8,
            'username' => 'users5',
            'email' => 'users5@usersmail.com',
            'password' => Hash::make('users5'),
            'admin' => 0,
            'vendor' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'id' => 9,
            'username' => 'admin',
            'email' => 'admin@usersmail.com',
            'password' => Hash::make('admin'),
            'admin' => 1,
            'vendor' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
