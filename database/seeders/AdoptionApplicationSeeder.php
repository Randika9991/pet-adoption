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


//Seeding the Database: Factory එක seeder file එකක භාවිතා කරලා database එකට data populate කරන්නත් පුළුවන්.
// පළමුව seeder එකක් create කරන්න:

    //php artisan make:seeder AdoptionApplicationSeeder

    //Seeder එක Define කිරීම: Generated AdoptionApplicationSeeder.php file එක තුළ factory එක call කරන්න:

            //public function run()
            //{
            //    // Create 10 fake adoption applications
            //    AdoptionApplication::factory()->count(10)->create();
            //}

    //Seeder එක Run කිරීම: ඒ සියල්ලක් set up කරාම, seeder එක run කරන්න

            //php artisan db:seed --class=AdoptionApplicationSeeder

    //හෝ සියලුම seeders run කිරීමට:

            //php artisan db:seed








