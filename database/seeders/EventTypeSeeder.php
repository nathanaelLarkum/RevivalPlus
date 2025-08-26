<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTypes = [
            'Morning Service',
            'Evening Service',
            'Youth Night',
            'Small Group',
            'Bible Study',
            'Worship Practice',
            'Community Outreach',
            'Prayer Meeting',
        ];

        foreach ($eventTypes as $name) {
            EventType::firstOrCreate([
                'slug' => Str::slug($name)
            ], [
                'name' => $name,
            ]);
        }
    }
}
