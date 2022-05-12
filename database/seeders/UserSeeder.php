<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                "name" => "user1",
                "email" => "user1@gmail.com",
                'password' => Hash::make('password'),
            ],
            [
                "name" => "user2",
                "email" => "user2@gmail.com",
                'password' => Hash::make('password'),
            ],

        ];
        User::insert($user);
    }
}
