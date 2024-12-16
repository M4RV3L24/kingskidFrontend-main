<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Event;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        Event::create([
            'name' => 'Available',
            'description' => 'donasi yang tersedia dan belum digunakan',

        ]);
        for ($i = 0; $i < 5; $i++) {
            Event::create([
                'name' => 'Event ' . $i,
                'nominal' => 1000000,
                'description' => 'Description of event ' . $i,
                'start_date' => now(),
                'end_date' => now()->addDays(7),
            ]);
        }
    }
}
