<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        $this->call(PetSeeder::class);

        $this->call(AdoptionApplicationSeeder::class);
    }
}


//සියලුම seeders run කිරීමට:

//php artisan db:seed
