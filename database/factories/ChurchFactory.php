<?php

namespace Database\Factories;

use App\Models\Denomination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Church>
 */
class ChurchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Corrected line: Instead of creating a new denomination,
            // get a random one that already exists from the seeder.
            'denomination_id' => Denomination::inRandomOrder()->first()->id,
            'name' => 'Community Church of ' . $this->faker->city,
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'zip_code' => $this->faker->postcode(),
            'latitude' => $this->faker->latitude(34, 40),
            'longitude' => $this->faker->longitude(-120, -80),
            'phone_number' => $this->faker->optional()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'website_url' => $this->faker->optional()->url(),
            'timezone' => $this->faker->timezone(),
        ];
    }
}
