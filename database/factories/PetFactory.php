<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class PetFactory extends Factory
{
    /**
     * The name of the model that is being factory-generated.
     *
     * @var string
     */
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $imagePath = $this->faker->image('storage/app/public/images', 640, 480, null, false);
        logger('Generated image: ' . $imagePath); // Log the generated path
        return [
            'user_id' => User::factory(),
            'petname' => $this->faker->name,  // Generating a random pet name
            'category' => $this->faker->randomElement(['Cat', 'Dog', 'Rabbit', 'Bird']),  // Random category
            'breed' => $this->faker->word,  // Random breed
            'age' => $this->faker->numberBetween(1, 15),  // Random age between 1 and 15
            'gender' => $this->faker->randomElement(['male', 'female']),
            'story' => $this->faker->paragraph,  // Random story for the pet
            'is_adopted' => $this->faker->boolean,  // Random boolean (true/false)
            'image' => 'images/' . $imagePath,
            'address' => $this->faker->address, // Generate a random address
            'phone' => $this->faker->phoneNumber,
            ];
    }
}
