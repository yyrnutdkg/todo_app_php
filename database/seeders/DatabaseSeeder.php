<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        //$this->call(UsersTableSeeder::class);
        DB::table('users')->delete();
        DB::table('todos')->delete();
        \App\Models\User::factory(5)->create();
        \App\Models\Todo::factory(5)->create();
    }
}
