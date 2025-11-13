<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {


        DB::table('events')->insert([
            [
                'host_id' => '1',
                'event' => 'Cultural Dance Night',
                'description' => 'A celebration of traditional dance.',
                'location' => 'Odense Munkemose Park',
                'date' => '2025-11-10 19:00:00',
                'price' => 50,
                'available_seats' => 30,
            ],
            [
                'host_id' => '1',
                'event' => 'Live Jazz Evening',
                'description' => 'Smooth jazz and good vibes all night :D.',
                'location' => 'Storms Pakhus',
                'date' => '2025-11-25 20:00:00',
                'price' => 119.99,
                'available_seats' => 45,
            ],
            [
                'host_id' => '1',
                'event' => 'Outdoor Movie Night',
                'description' => 'Watch old Italian mafia movies. Bring your own blanket and enjoy popcorn and pizza.',
                'location' => 'Munke Mose Park',
                'date' => '2025-08-15 21:00:00',
                'price' => 80,
                'available_seats' => 100,
            ],
            [
                'host_id' => '1',
                'event' => 'Street Food Festival',
                'description' => 'A day of delicious international street food, music, and entertainment for food freaks.',
                'location' => 'SDU UNI Parking',
                'date' => '2025-09-07 11:00:00',
                'price' => 20.5,
                'available_seats' => 400,
            ],
        ]);
    }
}
