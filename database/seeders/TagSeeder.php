<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data structure now includes an emoji for each tag name
        $tags = [
            'service-style' => [
                ['name' => 'Modern', 'emoji' => '✨'],
                ['name' => 'Vibrant Worship', 'emoji' => '🎉'],
                ['name' => 'Calm / Reflective', 'emoji' => '😌'],
                ['name' => 'Traditional / Liturgical', 'emoji' => '🏛️'],
                ['name' => 'Miracles / Prophetic', 'emoji' => '🙏'],
                ['name' => 'Historic Architecture', 'emoji' => '🏰'],
            ],
            'language' => [
                ['name' => 'German', 'emoji' => '🇩🇪'],
                ['name' => 'English', 'emoji' => '🇬🇧'],
                ['name' => 'Spanish', 'emoji' => '🇪🇸'],
                ['name' => 'Portuguese', 'emoji' => '🇵🇹'],
                ['name' => 'French', 'emoji' => '🇫🇷'],
                ['name' => 'Russian', 'emoji' => '🇷🇺'],
                ['name' => 'Ukrainian', 'emoji' => '🇺🇦'],
                ['name' => 'Arabic', 'emoji' => '🇸🇦'],
                ['name' => 'Other', 'emoji' => '🏳️'],
            ],
            'translation' => [
                ['name' => 'German', 'emoji' => '🇩🇪'],
                ['name' => 'English', 'emoji' => '🇬🇧'],
                ['name' => 'Spanish', 'emoji' => '🇪🇸'],
                ['name' => 'Portuguese', 'emoji' => '🇵🇹'],
                ['name' => 'French', 'emoji' => '🇫🇷'],
                ['name' => 'Russian', 'emoji' => '🇷🇺'],
                ['name' => 'Ukrainian', 'emoji' => '🇺🇦'],
                ['name' => 'Arabic', 'emoji' => '🇸🇦'],
                ['name' => 'Other', 'emoji' => '🏳️'],
            ],
            'church-size' => [
                ['name' => 'Fewer than 50 members', 'emoji' => '😊'],
                ['name' => '50–150 members', 'emoji' => '🤗'],
                ['name' => '150–500 members', 'emoji' => '😄'],
                ['name' => 'More than 500 members', 'emoji' => '🤩'],
            ],
            'fellowship' => [
                ['name' => 'Coffee after the Service', 'emoji' => '☕'],
                ['name' => 'Breakfast before the Service', 'emoji' => '🥐'],
                ['name' => 'Lunch after the Service', 'emoji' => '🥪'],
                ['name' => 'Dinner after the Service', 'emoji' => '🍝'],
                ['name' => 'Hangout after the Service', 'emoji' => '🤙'],
            ],
            'service-offers' => [
                ['name' => 'Kids’ Programme', 'emoji' => '🧸'],
                ['name' => 'Creche / Baby Care', 'emoji' => '👶'],
                ['name' => 'Youth Programme', 'emoji' => '🛹'],
            ],
            'program' => [
                ['name' => 'Small Groups', 'emoji' => '👨‍👩‍👧‍👦'],
                ['name' => 'Discipleship Course', 'emoji' => '🌱'],
                ['name' => 'Bible Study', 'emoji' => '📖'],
                ['name' => 'Evangelism / Outreach', 'emoji' => '📣'],
                ['name' => 'Worship Nights', 'emoji' => '🎶'],
                ['name' => 'Prayer Nights', 'emoji' => '🕯️'],
                ['name' => 'Mission Trips', 'emoji' => '✈️'],
            ],
            'social-help' => [
                ['name' => 'Food Bank', 'emoji' => '🥫'],
                ['name' => 'Shelter', 'emoji' => '🏠'],
                ['name' => 'Clothing Donation', 'emoji' => '👕'],
                ['name' => 'Counselling', 'emoji' => '❤️‍🩹'],
                ['name' => 'Language Courses', 'emoji' => '✍️'],
                ['name' => 'Study Spaces', 'emoji' => '📚'],
            ],
            'accessibility' => [
                ['name' => 'Wheelchair Accessible', 'emoji' => '♿'],
                ['name' => 'Sign Language Interpreter', 'emoji' => '🤟'],
                ['name' => 'Braille Materials', 'emoji' => '⠏'],
                ['name' => 'Accessible toilet', 'emoji' => '🚻'],
                ['name' => 'Parking', 'emoji' => '🅿️'],
                ['name' => 'Bicycle Racks', 'emoji' => '🚲'],
                ['name' => 'Livestream', 'emoji' => '🔴'],
            ],
        ];

        foreach ($tags as $category => $tagItems) {
            foreach ($tagItems as $item) {
                Tag::firstOrCreate(
                    ['slug' => Str::slug($category . ' ' . $item['name'])],
                    [
                        'name' => $item['name'],
                        'category' => $category,
                        'emoji' => $item['emoji'],
                    ]
                );
            }
        }
    }
}
