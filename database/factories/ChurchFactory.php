<?php

namespace Database\Factories;

use App\Models\Country;
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
            'name' => $this->faker->company() . ' Church',
            'denomination_id' => Denomination::inRandomOrder()->first()->id,
            'country_id' => Country::inRandomOrder()->first()->id,
            'address_line_1' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state_province_region' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'latitude' => $this->faker->latitude(34, 40),
            'longitude' => $this->faker->longitude(-120, -80),
            'email' => $this->faker->unique()->safeEmail(),
            'timezone' => $this->faker->timezone(),
            'website_url' => $this->faker->optional()->url(),
            'instagram_url' => $this->faker->optional()->url(),
            'facebook_url' => $this->faker->optional()->url(),
        ];
    }
}
