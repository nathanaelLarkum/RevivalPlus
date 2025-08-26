<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Church;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the seeders for our lookup tables first
        $this->call([
            DenominationSeeder::class,
            AmenitySeeder::class,
            EventTypeSeeder::class,
        ]);

        // Create a specific user for easy login
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create 10 other random users
        $users = User::factory(10)->create();
        $users->push($testUser); // Add our test user to the collection

        // Cache IDs from lookup tables for efficiency
        $amenityIds = Amenity::pluck('id');
        $eventTypeIds = EventType::pluck('id');

        // Create 50 churches, and for each church, create related data
        Church::factory(50)->create()->each(function ($church) use ($users, $amenityIds, $eventTypeIds) {
            // Attach a random number of amenities to each church
            $church->amenities()->attach(
                $amenityIds->random(rand(2, 6))->all()
            );

            // Create between 2 and 5 events for each church
            Event::factory(rand(2, 5))->create([
                'church_id' => $church->id,
                'event_type_id' => $eventTypeIds->random(),
            ]);

            // Create between 5 and 20 reviews for each church from random users
            Review::factory(rand(5, 20))->create([
                'church_id' => $church->id,
                'user_id' => $users->random()->id,
            ]);
        });
    }
}
