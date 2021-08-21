<?php

namespace Database\Seeders;

use App\Models\JobDescription;
use Illuminate\Database\Seeder;

class JobDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobDescription::create([
            'name' => 'Receptionist'
        ]);

        JobDescription::create([
            'name' => 'Room attendant'
        ]);

        JobDescription::create([
            'name' => 'Doorman'
        ]);

        JobDescription::create([
            'name' => 'Poter'
        ]);

        JobDescription::create([
            'name' => 'Chefs'
        ]);
    }
}
