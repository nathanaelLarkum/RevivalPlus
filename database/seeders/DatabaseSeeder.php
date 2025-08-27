<?php

namespace Database\Seeders;

use App\Models\Church;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Review;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the lookup table seeders first to ensure data is available
        $this->call([
            CountrySeeder::class,
            DenominationSeeder::class,
            TagSeeder::class,
            EventTypeSeeder::class,
        ]);

        // Create 10 users
        $users = User::factory(10)->create();

        // Create 50 churches and their related data
        Church::factory(50)->create()->each(function ($church) use ($users) {
            // Attach a random number of tags to each church
            $tags = Tag::inRandomOrder()->limit(rand(5, 15))->get();
            $church->tags()->attach($tags);

            // Create a few events for each church
            $eventTypes = EventType::inRandomOrder()->limit(rand(1, 4))->get();
            foreach ($eventTypes as $eventType) {
                Event::factory()->create([
                    'church_id' => $church->id,
                    'event_type_id' => $eventType->id,
                ]);
            }

            // Create a few reviews for each church from random users
            Review::factory(rand(1, 10))->create([
                'church_id' => $church->id,
                'user_id' => $users->random()->id,
            ]);
        });
    }
}
