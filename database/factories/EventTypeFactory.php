<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventType>
 */
class EventTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Morning Service', 'Evening Service', 'Youth Night', 'Small Group',
            'Bible Study', 'Worship Practice', 'Community Outreach'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
