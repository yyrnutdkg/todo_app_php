<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'name'    => 'user1',
                'email' => 'user1@example.com',
                'password' => Hash::make('user0101'),
            ],
            [
                'name'    => 'user6',
                'email' => 'user6@example.com',
                'password' => Hash::make('user0606'),
            ]
         ]);
    }
}
