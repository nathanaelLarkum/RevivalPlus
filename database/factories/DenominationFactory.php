<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Denomination>
 */
class DenominationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Southern Baptist', 'United Methodist', 'Non-Denominational', 'Catholic',
            'Presbyterian (PCUSA)', 'Lutheran (ELCA)', 'Episcopal', 'Assemblies of God'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(3),
        ];
    }
}
