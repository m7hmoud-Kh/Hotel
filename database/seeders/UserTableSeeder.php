<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make(123456)
        ]);


        User::create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make(123456)
        ]);



        User::create([
            'name' => 'user3',
            'email' => 'user3@gmail.com',
            'password' => Hash::make(123456)
        ]);



        User::create([
            'name' => 'user4',
            'email' => 'user4@gmail.com',
            'password' => Hash::make(123456)
        ]);



        User::create([
            'name' => 'user5',
            'email' => 'user5@gmail.com',
            'password' => Hash::make(123456)
        ]);



        User::create([
            'name' => 'user6',
            'email' => 'user6@gmail.com',
            'password' => Hash::make(123456)
        ]);



        User::create([
            'name' => 'user7',
            'email' => 'user7@gmail.com',
            'password' => Hash::make(123456)
        ]);

    }
}
