<?php

namespace Database\Seeders;

use App\Models\Roomtype;
use Illuminate\Database\Seeder;

class RoomtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roomtype::create([
            'type' => 'Single',
            'description'=> 'A room assigned to one person. May have one or more beds.',
            'price' => '50',
        ]);

        Roomtype::create([
            'type' => 'Double',
            'description'=> 'A room assigned to two people. May have one or more beds.',
            'price' => '100',

        ]);
        Roomtype::create([
            'type' => 'Triple',
            'description'=> 'A room assigned to three people. May have two or more beds.',
            'price' => '150',

        ]);
        Roomtype::create([
            'type' => 'Quad',
            'description'=> 'A room assigned to four people. May have two or more beds.',
            'price' => '200',

        ]);
        Roomtype::create([
            'type' => 'Queen',
            'description'=> 'A room assigned to one person. May have one or more beds.',
            'price' => '250',

        ]);
        Roomtype::create([
            'type' => 'King',
            'description'=> 'A room with a king-sized bed. May be occupied by one or   more people',
            'price' => '300',

        ]);
        Roomtype::create([
            'type' => 'Twin',
            'description'=> 'A room with two beds. May be occupied by one or more people.',
            'price' => '350',

        ]);
        Roomtype::create([
            'type' => 'Double-double',
            'description'=> 'A room with two double (or perhaps queen) beds. May be occupied by one or more people.',
            'price' => '400',

        ]);
        Roomtype::create([
            'type' => 'Studio',
            'description'=> 'A room with a studio bed – a couch that can be converted into a bed. May also have an additional bed',
            'price' => '450',

        ]);
        Roomtype::create([
            'type' => 'Mini-Suite',
            'description'=> 'A single room with a bed and sitting area. Sometimes the sleeping area is in a bedroom separate from the parlour or living room.',
            'price' => '500',

        ]);


        Roomtype::create([
            'type' => 'Master Suite',
            'description'=> 'A parlour or living room connected to one or more bedrooms',
            'price' => '550',

        ]);
    }
}
