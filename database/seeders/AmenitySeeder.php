<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            'Youth Group',
            'Kids Ministry',
            'Free Breakfast',
            'Mid-week Small Groups',
            'Social Events',
            'Wheelchair Accessible',
            'Live Translation',
            'Online Streaming',
            'Community Outreach',
            'Free Parking',
        ];

        foreach ($amenities as $name) {
            Amenity::firstOrCreate([
                'slug' => Str::slug($name)
            ], [
                'name' => $name,
            ]);
        }
    }
}
