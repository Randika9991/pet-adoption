<?php

namespace Database\Factories;

use App\Models\AdoptionApplication;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdoptionApplicationFactory extends Factory
{
    protected $model = AdoptionApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'user_name' => $this->faker->name(),  // Generate a random name for the user
            'email' => $this->faker->safeEmail(),  // Generate a unique email
            'pet_id' => Pet::factory(),
            'application_date' => $this->faker->date(),  // Generate a random date
            'status' => $this->faker->randomElement(['pending']),  // Generate a random status
        ];
    }

}


//මෙම AdoptionApplicationFactory එක, adoption application එකක් සඳහා default values define කරන්න ලැහැස්ති කරනවා.
// මේකෙන් Laravel එකේ testing වලට fake data generate කර ගන්න පුළුවන්.

//Factory එක Run කිරීමේ පියවර:------

    //Tinker හරහා Fake Data Generate කිරීම: Laravel එකේ Tinker tool එක භාවිතා කරලා interactively fake data generate කරන්න පුළුවන්.
    //පළමුව Tinker එක run කරන්න:
        //php artisan tinker

        //එක record එකක් create කිරීමට:
            //AdoptionApplication::factory()->create();

        //නැතහොත් multiple records create කරන්න:
            //AdoptionApplication::factory()->count(10)->create();







