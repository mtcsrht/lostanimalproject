<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Animal;
use App\Models\User;
use Ramsey\Uuid\Uuid; 
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageUuid = Uuid::uuid4()->toString();
        $imageUrl = $this->faker->imageUrl(512, 512, 'animals', true);
        $imageContents = file_get_contents($imageUrl);

        $imagePath = 'animal-pictures/' . $imageUuid . '.jpg'; // Simpler path
        Storage::disk('public')->put($imagePath, $imageContents); // Use Laravel's storage
        
        return[
            'uuid' => Uuid::uuid4()->toString(),
            'userId' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->word().$this->faker->word(),
            'chipNumber' => $this->faker->randomNumber(9),
            'gender' => $this->faker->randomElement([0,1]),
            'colorid' => $this->faker->randomElement([1,2,3,4,5,6,7]),
            'description' => $this->faker->text(1000),
            'image' => $imagePath,
        ];
    }
}
