<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'type_id' => 1,
            'price' => 100,
        ]);

        Room::create([
            'type_id' => 2,
            'price' => 150,
        ]);

        Room::create([
            'type_id' => 3,
            'price' => 200,
        ]);

        Room::create([
            'type_id' =>4,
            'price' => 250,
        ]);

        Room::create([
            'type_id' =>5,
            'price' => 300,
        ]);

        Room::create([
            'type_id' => 6,
            'price' => 350,
        ]);

        Room::create([
            'type_id' => 7,
            'price' => 400,
        ]);

        Room::create([
            'type_id' => 8,
            'price' => 450,
        ]);

        Room::create([
            'type_id' => 9,
            'price' => 500,
        ]);


        Room::create([
            'type_id' => 10,
            'price' => 550,
        ]);

        Room::create([
            'type_id' => 11,
            'price' => 600,
        ]);


    }
}
