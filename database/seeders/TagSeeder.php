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
        $tags = [
            'service-style' => ['Modern', 'Vibrant Worship', 'Calm / Reflective', 'Traditional / Liturgical', 'Miracles / Prophetic', 'Historic Architecture'],
            'language' => ['German', 'English', 'Spanish', 'Portuguese', 'French', 'Russian', 'Ukrainian', 'Arabic', 'Other'],
            'translation' => ['German', 'English', 'Spanish', 'Portuguese', 'French', 'Russian', 'Ukrainian', 'Arabic', 'Other'],
            'church-size' => ['Fewer than 50 members', '50–150 members', '150–500 members', 'More than 500 members'],
            'fellowship' => ['Coffee after the Service', 'Breakfast before the Service', 'Lunch after the Service', 'Dinner after the Service', 'Hangout after the Service'],
            'service-offers' => ['Kids’ Programme', 'Creche / Baby Care', 'Youth Programme'],
            'program' => ['Small Groups', 'Discipleship Course', 'Bible Study', 'Evangelism / Outreach', 'Worship Nights', 'Prayer Nights', 'Mission Trips'],
            'social-help' => ['Food Bank', 'Shelter', 'Clothing Donation', 'Counselling', 'Language Courses', 'Study Spaces'],
            'accessibility' => ['Wheelchair Accessible', 'Sign Language Interpreter', 'Braille Materials', 'Accessible toilet', 'Parking', 'Bicycle Racks', 'Livestream'],
        ];

        foreach ($tags as $category => $names) {
            foreach ($names as $name) {
                Tag::firstOrCreate(
                    ['slug' => Str::slug($category . ' ' . $name)],
                    [
                        'name' => $name,
                        'category' => $category,
                    ]
                );
            }
        }
    }
}
