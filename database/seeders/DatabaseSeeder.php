<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Dunyaxanim",
            'last_name' => "Yusifova",
            'phone' => "050-896-05-04",
            'type' => "1",
            'email' => 'dunyaxanim.ysfv@gmail.com',
            'password' => Hash::make('1111'),
        ]);
    }
}