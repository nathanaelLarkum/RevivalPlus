<?php

namespace Database\Factories;

use App\Models\Church;
use App\Models\EventType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'church_id' => Church::factory(),
            'event_type_id' => EventType::factory(),
            'day_of_week' => $this->faker->numberBetween(0, 6), // 0=Sunday, 6=Saturday
            'start_time' => $this->faker->randomElement(['09:00:00', '11:00:00', '18:30:00', '19:00:00']),
            'end_time' => null,
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
