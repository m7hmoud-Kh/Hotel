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
        $this->call([
            UserTableSeeder::class,
            AdminTableSeeder::class,
            JobDescriptionTableSeeder::class,
            RoomtypeSeeder::class,
            RoomTableSeeder::class,
        ]);
    }
}
