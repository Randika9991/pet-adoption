<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdoptionApplication;

class AdoptionApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 fake adoption applications
        AdoptionApplication::factory()->count(10)->create();
    }
}

