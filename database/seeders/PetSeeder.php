<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet; // Import the Pet model

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pet::factory(5)->create();

    }
}
