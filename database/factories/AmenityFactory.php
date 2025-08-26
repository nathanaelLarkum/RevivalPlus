<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Amenity>
 */
class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Youth Group', 'Kids Ministry', 'Free Breakfast', 'Mid-week Small Groups',
            'Social Events', 'Wheelchair Accessible', 'Live Translation', 'Online Streaming'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'icon_svg' => null, // You can add SVG code here later
        ];
    }
}
