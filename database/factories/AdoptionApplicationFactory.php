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
